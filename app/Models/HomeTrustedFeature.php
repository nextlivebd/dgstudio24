<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTrustedFeature extends Model
{
    use HasFactory;

    protected $table = 'home_trusted_features';

    protected $fillable = [
        'icon',
        'title',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];
}
