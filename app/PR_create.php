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
        'pdf'
      ];
      public function transform()
      {
        return $this->hasOne('App\Transform', 'id');
      }
    
      public function product()
      {
        return $this->hasOne('App\Product', 'id');
      }

      public function prequest()
      {
        return $this->belongsTo('App\prequest');
      }
}
