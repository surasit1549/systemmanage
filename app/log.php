<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    public $fillable = ['email','where','action'];
}
