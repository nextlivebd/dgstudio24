<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'thumbnail', 'status',
        'meta_title', 'meta_description', 'meta_keywords', 
        'is_featured', 'views', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
