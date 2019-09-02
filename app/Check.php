<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable=[
        'PO_ID',
        'keyPR',
        'store_ID'
    ];
}
