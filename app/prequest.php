<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prequest extends Model
{
    protected $fillable=[
        'keyPR',
        'date',
        'contractor',
        'formwork',
        'prequestconvert'
  ];
  public function transform(){
    return $this->hasOne('App\Transform','id');
  }
  
  public function store(){
    return $this->hasOne('App\Store','id');
  }

  public function product(){
    return $this->hasOne('App\Product','id');
  }

  public function porder(){
    return $this->belongsTo('App\porder');
  }
}
