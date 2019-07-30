<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class porder extends Model
{
    
    protected $fillable=[
        'keyPR',
        'date',
        'keystore'
        
    ];

    public function prequest(){
        return $this->hasOne('App\prequest','id');
    }

    public function product(){
        return $this->hasOne('App\Product','id');
    }

    public function transform(){
        return $this->hasOne('App\Transform','id');
    }

    public function store(){
        return $this->hasOne('App\Store','id');
    }

}
