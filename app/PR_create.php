<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PR_create extends Model
{
    protected $fillable = [
        'key',
        'date',
        'contractor',
        'formwork',
        'prequestconvert',
        'created_at'
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
