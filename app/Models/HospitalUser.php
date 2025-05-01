<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HospitalUser extends Model
{
    use HasFactory, Notifiable;

    // Allow mass-assignment of both the FK and all user fields
    protected $fillable = [
        'name',
        'ic',
        'address',

        // These two columns handle your hospital link:
        'hospital_code',   // the human-readable code the user picks
        'hospital_id',     // the numeric FK pointing at hospitals.id

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

    public function hospital()
    {
        // foreign key = hospital_code, owner key = code
        return $this->belongsTo(Hospital::class, 'hospital_code', 'code');
    }
    /**
     * If this user is a patient, their uploaded images.
     */
    public function images()
    {
        return $this->hasMany(PatientImage::class, 'hospital_user_id');
    }

    /**
     * If this user is a patient, their generated reports.
     */
    public function reports()
    {
        return $this->hasMany(PatientReport::class, 'hospital_user_id');
    }
    public function reviews()
    {
        return $this->hasMany(DoctorReview::class, 'patient_id');
    }
    /**
     * Assigned staff relationships.
     */
    public function assignedDoctor()
    {
        return $this->belongsTo(self::class, 'assigned_doctor_id');
    }

    public function assignedRadiologist()
    {
        return $this->belongsTo(self::class, 'assigned_radiologist_id');
    }

    public function assignedRadiographer()
    {
        return $this->belongsTo(self::class, 'assigned_radiographer_id');
    }

    /**
     * Profile photo URL accessor, with a default fallback.
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : asset('images/default-avatar.png');
    }
}
