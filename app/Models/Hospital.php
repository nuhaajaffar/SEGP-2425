<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'hospital_id',
        'pic_name',
        'pic_contact',
        'secondary_contact',
        'pic_username',
        'pic_password',
        'license',
    ];
}
