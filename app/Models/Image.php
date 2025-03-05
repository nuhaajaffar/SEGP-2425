<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    // Allow mass assignment for filename and path
    protected $fillable = ['filename', 'path'];
}
