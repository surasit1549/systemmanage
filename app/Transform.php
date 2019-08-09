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

    public function porder(){
      return $this->belongsTo('App\porder');
    }

    public function pr_create(){
      return $this->belongsTo('App\PR_create');
    }
}
