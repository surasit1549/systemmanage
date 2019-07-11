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
        'prequestconvert',
        'productname',
        'productnumber',
        'unit',
        'keystore',
        'price',
        'sum',
        'newdate'
  ];
  public function transform(){
  return $this->hasOne('App\Transform','id');
  }
  
  public function store(){
  return $this->hasOne('App\Store','id');
  }
  public function porder(){
    return $this->belongsTo('App\porder');
}
}
