<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    public $fillable = ['username', 'action', 'table', 'previous_data', 'new_data', 'element'];
}
