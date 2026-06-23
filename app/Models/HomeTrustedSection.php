<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTrustedSection extends Model
{
    use HasFactory;

    protected $table = 'home_trusted_section';

    protected $fillable = [
        'subtitle',
        'title',
        'title_highlight',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
