<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; 

class HospitalUser extends Model
{
    use HasFactory, Notifiable;

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
        'assigned_doctor_id',
        'assigned_radiologist_id',
        'assigned_radiographer_id',
        'profile_photo',
    ];

    // Relationship: one HospitalUser has one PatientImage
    public function images()
    {
        return $this->hasMany(\App\Models\PatientImage::class, 'hospital_user_id');
    }

    public function reports()
    {
        return $this->hasMany(\App\Models\PatientReport::class, 'hospital_user_id');
    }
    
    public function assignedDoctor()
    {
        // This assumes that assigned_doctor_id stores the id of the doctor (also from the HospitalUser table).
        return $this->belongsTo(HospitalUser::class, 'assigned_doctor_id');
    }
    
    public function assignedRadiologist()
    {
        return $this->belongsTo(self::class, 'assigned_radiologist_id');
    }
    
    public function assignedRadiographer()
    {
        return $this->belongsTo(self::class, 'assigned_radiographer_id');
    }
    
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
             ? asset('storage/' . $this->profile_photo)
             : asset('images/default-avatar.png');
    }
}
