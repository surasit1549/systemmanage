<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Create_product extends Model
{
    protected $fillable = [
        'key',
        'productname',
        'productnumber',
        'unit'
    ];

    public function porder()
    {
        return $this->belongsTo('App\porder');
    }
}
