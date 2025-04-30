<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorReview extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'review'];

    public function doctor()
    {
        return $this->belongsTo(HospitalUser::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(HospitalUser::class, 'patient_id');
    }
}

