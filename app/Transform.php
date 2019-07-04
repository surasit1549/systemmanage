<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transform extends Model
{
    protected $fillable=[
                          'convertname',
                          'size'
                        ];

    public function prequest(){
      return $this->belongsTo('App\prequest');
    }
}
