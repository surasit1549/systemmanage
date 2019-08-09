<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PR_create extends Model
{
<<<<<<< HEAD
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
    
=======
    protected $fillable = ['keystore','construct_name','typework','convert'];
>>>>>>> 328e3aaf6654d08a3a58dbc65462c8cf074e22af
}
