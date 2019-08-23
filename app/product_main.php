<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_main extends Model
{
    protected $fillable=[
        'Product_ID',
        'Product_name',
        'unit'
    ];
}
