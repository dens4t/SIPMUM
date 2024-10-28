<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestProperty extends Model
{
    protected $table = 'guest_property';
    protected $guarded = [];
    use HasFactory;
}
