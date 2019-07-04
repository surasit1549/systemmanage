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
}
