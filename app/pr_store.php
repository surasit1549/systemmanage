<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pr_store extends Model
{
    protected $fillable = [
        'PO_ID',
        'keyPR',
        'Product_name',
        'Product_number',
        'unit',
        'keystore',
        'price',
        'product_sum',
        'sumofprice',
        'status'
      ];
}
