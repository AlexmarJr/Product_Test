<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profit = 0; $price_buy = 0; $price_sell = 0;

        $total_product = DB::table('products')->where('id_user', '=', Auth::id())->count('id');
        $total_registers = DB::table('products')->where('id_user', '=', Auth::id())->sum('quantity');
        $products =  DB::table('products')->where('id_user', '=', Auth::id())->get();
        foreach($products as $value){
            $profit = $profit + (($value->price_sell - $value->price_buy) * $value->quantity);
            $price_buy = $price_buy + ($value->price_buy * $value->quantity);
            $price_sell = $price_sell + ($value->price_sell * $value->quantity);
        }

        $data =  DB::table('products')->where('id_user', '=', Auth::id())->get();
        return view('home', compact('data','total_product','profit','price_buy','price_sell','total_registers'));
    }

    public function store_product(Request $request){
        $id = $request->get('id', false);
        $attr['id_user']= Auth::id();
        $attr['name_product']= $request->name_product;
        $attr['price_buy']= $request->price_buy;
        $attr['price_sell']= $request->price_sell;
        $attr['quantity']= $request->quant;
        try{
            if($id){
                $product = Product::find($id);
                $product->fill($attr);
                $product->save();
                flash("Produto Atualizado!")->success();
                return redirect()->route('home');
            }
            else{
                Product::create($attr);
                flash("Produto Registrado!")->success();
                return redirect()->route('home');
            }     
        }
        catch (\Exception $e) {
            flash($e)->error();
            return redirect()->route('home');
        }  
    }

    public function read($id){
        $data =  DB::table('products')->where('id_user', '=', Auth::id())->get();
        $head = Product::find($id);
        if($head->id_user == Auth::id()){
            return view('home', compact('data', 'head'));
        }
        else{
            flash('Produto não encontrado')->error();
            return redirect()->route('home');
        }
        
    }

    public function delete($id){
        $head = Product::find($id);
        if($head->id_user == Auth::id()){
        $head->delete();
        flash('Produto Deletado!')->error();
        return redirect()->route('home');
        }
        else{
            flash('Produto não encontrado')->error();
            return redirect()->route('home');
        }
    }
    /*
    public function geral_details(){
        $profit = 0; $price_buy = 0; $price_sell = 0;

        $total_product = DB::table('products')->where('id_user', '=', Auth::id())->count('id');
        $data =  DB::table('products')->where('id_user', '=', Auth::id())->get();
        foreach($data as $value){
            $profit = $profit + (($value->price_sell - $value->price_buy) * $value->quantity);
            $price_buy = $price_buy + ($value->price_buy * $value->quantity);
            $price_sell = $price_sell + ($value->price_sell * $value->quantity);
        }
    }
    */
}
