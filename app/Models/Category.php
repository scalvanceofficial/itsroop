<?php

namespace App\Models;

use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    use HasFactory, Hashidable;

    protected $fillable = [
        'property_ids',
        'name',
        'slug',
        'index',
        'image',
        'home_featured',
        'status',
    ];

    protected $casts = [
        'property_ids' => 'array',
    ];
}
