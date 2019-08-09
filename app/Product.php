<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'keyPR',
        'formwork',
        'productname',
        'productnumber',
        'unit',
        'keystore',
        'price',
        'sum'
    ];

    public function prequest(){
        return $this->belongsTo('App\prequest');
    }

    public function porder(){
        return $this->belongsTo('App\porder');
    }

    public function pr_create(){
        return $this->belongsTo('App\PR_create');
    }
}
