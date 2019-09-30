<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable=[
        'PO_ID',
        'keyPR',
        'Product_name',
        'surplus',
        'number_product',
        'status'
    ];
}
