<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['businessname', 'name', 'phone', 'email', 'services', 'website', 'message'];
}
