<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PR_create extends Model
{
    protected $fillable = [
        'date',
        'contractor',
        'formwork',
        'prequestconvert',
        'productname',
        'productnumber',
        'unit'
      ];
      public function transform()
      {
        return $this->hasOne('App\Transform', 'id');
      }
    
      public function product()
      {
        return $this->hasOne('App\Product', 'id');
      }
    
}
