<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeVideoBanner extends Model
{
    protected $fillable = [
        'title',
        'title_highlight',
        'description',
        'btn_text',
        'btn_url',
        'video_url',
        'background_image',
        'logo_source',
        'custom_logo',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
