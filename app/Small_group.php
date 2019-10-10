<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Small_group extends Model
{
    protected $fillable = [
        'Main_group',
        'Small_group',
        'Small_name',
        'Main_name'
    ];
}
