<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id_user','name_product', 'price_buy', 'price_sell','quantity',
    ];
}
