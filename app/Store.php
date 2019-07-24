<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable=[
                          'keystore',
                          'name',
                          'address',
                          'phone',
                          'fax',
                          'contect',
                          'cellphone'
                        ];

    public function prequeststore(){
      return $this->belongsTo('App\prequest');
    }

    public function porder(){
      return $this->belongsTo('App\porder');
    }
}
