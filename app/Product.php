<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'keyPR',
        'Product_name',
        'Product_number',
        'unit',
        'Store',
        'Price',
        'Product_sum',
        'sumallprice'
      ];
}
