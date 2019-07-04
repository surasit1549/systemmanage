<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prequest extends Model
{
  public function transform(){
    return $this->hasOne('App\Transform','id');
  }
}
