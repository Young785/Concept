<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'image_name' => 'array',
    ];
}
