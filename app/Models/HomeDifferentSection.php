<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDifferentSection extends Model
{
    protected $fillable = [
        'subtitle',
        'title',
        'title_highlight',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
