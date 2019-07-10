<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class porder extends Model
{
    public function prequest(){
        return $this->hasOne('App\prequest','id');
    }

}
