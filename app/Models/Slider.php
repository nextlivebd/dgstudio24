<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_image',
        'front_image',
        'subtitle',
        'title_1',
        'title_2',
        'description',
        'button_1_text',
        'button_1_link',
        'button_2_text',
        'button_2_link',
        'status',
        'order',
    ];
}
