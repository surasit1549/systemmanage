<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prequest extends Model
{
  protected $fillable = [
    'keyPR',
    'date',
    'formwork',
    'prequestconvert',
    'sumofprice'

  ];
  
}
