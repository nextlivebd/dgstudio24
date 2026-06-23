<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDifferentTab extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'content_title',
        'content_description',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];
}
