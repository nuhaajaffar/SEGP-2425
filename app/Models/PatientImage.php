<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientImage extends Model
{
    use HasFactory;

    protected $fillable = ['hospital_user_id', 'image_path','status'];

    public function patient()
    {
        return $this->belongsTo(\App\Models\HospitalUser::class, 'hospital_user_id', 'id');
    }
}
