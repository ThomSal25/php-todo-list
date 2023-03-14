<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'is_complete', 
        'isDone'
    ];
}
