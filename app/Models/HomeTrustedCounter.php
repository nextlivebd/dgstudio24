<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTrustedCounter extends Model
{
    use HasFactory;

    protected $table = 'home_trusted_counters';

    protected $fillable = [
        'icon',
        'count',
        'label',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'count' => 'integer',
        'order' => 'integer',
    ];
}
