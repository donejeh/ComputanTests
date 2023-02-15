<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiData extends Model
{
    use HasFactory;

    protected $casts = [
        'HTTPS' => 'boolean',
      ];

    protected $fillable = [
        'API',
        'Description',
        'Auth',
        'HTTPS',
        'Cors',
        'Link',
        'Category',
    ];

    
}
