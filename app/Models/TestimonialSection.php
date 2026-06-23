<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialSection extends Model
{
    use HasFactory;

    protected $table = 'testimonial_section';

    protected $fillable = [
        'subtitle',
        'title',
        'title_highlight',
        'cta_text',
        'cta_phone',
        'right_image',
        'experience_count',
        'experience_label',
        'status',
    ];

    protected $casts = [
        'status'           => 'boolean',
        'experience_count' => 'integer',
    ];
}
