<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prequest extends Model
{
  protected $fillable = [
    'keyPR',
    'date',
    'contractor',
    'formwork',
    'prequestconvert',
    'sumofprice'

  ];
  public function transform()
  {
    return $this->hasOne('App\Transform', 'id');
  }

  public function store()
  {
    return $this->hasOne('App\Store', 'id');
  }

  public function product()
  {
    return $this->hasOne('App\Product', 'id');
  }
  public function pr_create()
  {
    return $this->hasOne('App\PR_create', 'id');
  }
  public function create_product()
  {
    return $this->hasOne('App\Create_product', 'id');
  }

  public function porder()
  {
    return $this->belongsTo('App\porder');
  }
  
}
