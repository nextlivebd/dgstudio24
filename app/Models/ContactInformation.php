<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $table = 'contact_information';

    protected $fillable = [
        'office_name',
        'addresses',
        'phones',
        'emails',
        'map_embed',
        'is_active',
    ];

    protected $casts = [
        'addresses' => 'array',
        'phones' => 'array',
        'emails' => 'array',
        'is_active' => 'boolean',
    ];
}
