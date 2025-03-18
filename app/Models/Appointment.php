<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'dob',
        'ic',
        'address',
        'username',
        'doctor_id',
        'radiologist_id',
        'radiographer_id',
        'appointment_date',
    ];

    public function doctor()
    {
        return $this->belongsTo(\App\Models\HospitalUser::class, 'doctor_id');
    }

    public function radiologist()
    {
        return $this->belongsTo(\App\Models\HospitalUser::class, 'radiologist_id');
    }

    public function radiographer()
    {
        return $this->belongsTo(\App\Models\HospitalUser::class, 'radiographer_id');
    }
}
