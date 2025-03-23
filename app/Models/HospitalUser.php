<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ic',
        'address',
        'hospital_id',
        'role',
        'contact',
        'username',
        'password',
        'dob',
        'sex',
    ];

    // Relationship: one HospitalUser has one PatientImage
    public function images()
    {
        return $this->hasMany(\App\Models\PatientImage::class, 'hospital_user_id', 'id');
    }

    public function report()
    {
        // A patient can have one report (use hasOne, or hasMany if needed)
            return $this->hasOne(\App\Models\PatientReport::class, 'hospital_user_id');

    }
    public function assignedDoctor()
    {
        return $this->belongsTo(HospitalUser::class, 'assigned_doctor_id');
    }
    
    public function assignedRadiologist()
    {
        return $this->belongsTo(HospitalUser::class, 'assigned_radiologist_id');
    }
    
    public function assignedRadiographer()
    {
        return $this->belongsTo(HospitalUser::class, 'assigned_radiographer_id');
    }
}
