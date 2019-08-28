<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $fillable = ['first_name','last_name','username','password','role','signature','email','address','phone','token','token_refresh'];
}
