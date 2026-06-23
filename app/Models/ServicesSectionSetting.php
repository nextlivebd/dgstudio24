<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesSectionSetting extends Model
{
    use HasFactory;

    protected $table = 'services_section_settings';

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
