<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageUnit extends Model
{
    protected $table = 'page_unit';
    protected $guarded = [];
    protected $casts = [
        'thumbnail' => 'array'
    ];

}
