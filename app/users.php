<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $fillable = ['name','phone_number','address','username','password','priority'];
}
