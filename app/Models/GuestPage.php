<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestPage extends Model
{
    protected $table = 'guest_page';
    protected $guarded = [];
    use HasFactory;
    protected $casts = [
        'thumbnail' => 'array',
    ];
}
