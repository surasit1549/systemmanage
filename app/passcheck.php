<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class passcheck extends Model
{
    protected $fillable = ['username','passcode'];
}
