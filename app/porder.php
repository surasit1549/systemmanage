<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class porder extends Model
{
    
    protected $fillable=[
        'PO_ID',
        'keyPR',
        'store_ID',
        'status'
    ];

}
