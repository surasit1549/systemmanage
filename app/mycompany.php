<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mycompany extends Model
{
    protected $fillable = ['name','address','phone','fax','contact_name', 'contact_phone', 'logo'];
}
