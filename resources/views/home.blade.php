@extends('layouts.app')

<style>
body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        background-image: url('/img/back_home.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
    .img-q{
    height: 200px;
    width: 200px;
}
.q{
    position: absolute;
    top: 120px;
}
</style>
<button type="button" class="btn btn-primary q" data-toggle="modal" data-target=".news-modal" style="padding: 24px">Fique Atualizado: Noticias!</button>
@section('content')

@if(isset($head))
    <script>$(document).ready(function(){
    $("#store_task").modal('show');
    });</script> 
@endif

<form action="{{route('store_product')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<input type="hidden" @if(isset($head)) value="{{$head->id}}" name="id" @endif>
<div class="container" style="border: 2px solid black; background-color: white">
@include('flash::message')

    <div class="row">
    
        <div class="col">
            <button type="button" class="btn btn-success" style="padding: 15px; margin-top: 15px" data-toggle="modal" data-target="#store_task">@if(isset($head)) Editar Produto @else Adicionar Produto @endif</button>
        </div>
        @if(isset($head))
            <div class="col">
                <a class="btn btn-warning" href="{{route('home')}}" style="padding: 15px; margin-top: 15px" >Voltar</a>
            </div>
        @endif
         
        <div class="col">
            <h2 style="text-align: center; margin-top: 15px;" >Seus produtos</h2>
        </div>
            
        <div class="col">
            @if(isset($head)) @else<a type="button" class="btn btn-warning" style="padding: 15px; margin-top: 15px; float: right" data-toggle="modal" data-target=".bd-example-modal-lg">Abrir Detalhes Gerais</a> @endif
        </div>
    </div>
    <hr>
    <table class="table">
        <tr>
            <th scope="">Nome</th>
            <th scope="">Preço de Compra</th>
            <th scope="">Preço de Venda</th>
            <th scope="">Quantidade</th>
            <th scope="">Actions</th>
        </tr>
            @foreach($data as $value)
        <tr>
            <td width="35%" style="text-transform: uppercase">{{$value->name_product}}</td>
            <td class="">{{$value->price_buy}}</td>
            <td class="">{{$value->price_sell}}</td>
            <td class="">{{$value->quantity}}</td>
            <td width="" style="float: right"><a class="btn btn-primary" href="{{route('read', $value->id)}}">Detalhes</a> <a href="{{route('delete', $value->id)}}" class="btn btn-danger">Delete</a></td>
        </tr>
            @endforeach
    </table>
</div>


<!-- Modal de Adicionar Produto--> 

<div class="modal fade store_task-lg" id="store_task" tabindex="-1" role="dialog" aria-labelledby="storage_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storage_modal_title">@if(isset($head)) Editar Produto @else Adicionar Produto @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 10px">
                    <div class="col-sm-12">
                        <label>Task Name</label>
                        <input class="form-control" name="name_product" placeholder="Nome do Produto" style="text-transform: uppercase" @if(isset($head)) value="{{$head->name_product}}" @endif required>
                    </div>

                    <div class="col-sm-7">
                        <label>Preço de Compra</label>
                        <input class="dinheiro form-control" name="price_buy" placeholder="Valor" id="dinheiro" type="text" @if(isset($head)) value="{{$head->price_buy}}" @endif>
                    </div>

                    <div class="col-sm-7">
                        <label>Preço de Venda</label>
                        <input class="dinheiro form-control" name="price_sell" placeholder="Valor" id="dinheiro" type="text" @if(isset($head)) value="{{$head->price_sell}}" @endif>
                    </div>

                    <div class="col-sm-7">
                        <label>Quantidade</label>
                        <input class="form-control" name="quant" placeholder="Quantidade" type="number" min="0" @if(isset($head)) value="{{$head->quantity}}" @endif>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">@if(isset($head)) Editar @else Salvar @endif</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


<!-- Modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <table class="table">
            <tr>
                <th>Quantidade de Produtos</th>
                <th>Total de Registros</th>
                <th>Investimento</th>
                <th>Valor em Produtos</th>
                <th>Lucro Estimado</th>
            </tr>
            @if(!isset($head))
            <tr>
                <td>{{$total_registers}}</td>
                <td>{{$total_product}}</td>
                <td>{{$price_buy}} R$</td>
                <td>{{$price_sell}} R$</td>
                <td>{{$profit}} R$</td>
            </tr>
            @endif
        </table>
    </div>
  </div>
</div>

<!--News Modal-->
<div class="content">
        <?php 
        $url = "http://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=1c3d750ef01d454f889b2c1b65d5a5fe";
        $response = file_get_contents($url);
        $NewsData = json_decode($response);
        ?>
    </div>

    <div class="modal fade news-modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container fluid">
                    <example-component> </example-component>
                    
                <hr>
                    <?php
                        foreach($NewsData->articles as $News){
                    ?>
                    <div class="row grid" style="margin: 2px">
                        <div class="col-md-4">
                            <img class="img-q" src="<?php echo $News->urlToImage?>" >
                        </div>
                        <div class="col-md-8" style="text-align: center">
                            <h2><a href="<?php echo $News->url?>" style="color: black"> <?php echo $News->title ?> </a></h2>
                            <h5><?php echo $News->description?></h5>
                            <p><?php echo $News->content ?></p>
                            <h6>Autor: <?php echo $News->author?></h6>
                            <h6>Data: <?php echo $News->publishedAt ?></h6>
                        </div>           
                    <div>
                    <hr>
                    <?php }?>
                    
                </div>
            <div>
        </div>
    </div>
    
<script>
$('.dinheiro').mask('###0.00', {reverse: true});
</script>

@endsection
