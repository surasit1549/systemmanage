<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_Price extends Model
{
    protected $fillable=[
        'Cat_ID',
        'CatID',
        'Store',
        'Product',
        'Price'
    ];
}
