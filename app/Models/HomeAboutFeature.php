<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAboutFeature extends Model
{
    use HasFactory;

    protected $table = 'home_about_features';

    protected $fillable = [
        'icon',
        'title',
        'description',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
