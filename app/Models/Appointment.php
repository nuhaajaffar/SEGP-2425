<?php
// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'full_name',
        'dob',
        'ic',
        'address',
        'username',         // the patient’s username
        'doctor_id',
        'radiologist_id',
        'radiographer_id',
        'appointment_date',
    ];

    /** 
     * Link to the Doctor by id
     */
    public function doctor()
    {
        return $this->belongsTo(HospitalUser::class, 'doctor_id');
    }

    /**
     * Link to the Patient by matching username => username
     */
    public function patient()
    {
        return $this->belongsTo(
            HospitalUser::class,
            'username',  // this column on appointments
            'username'   // matches hospital_users.username
        );
    }

    protected $casts = [
        'appointment_date' => 'datetime',
    ];
}
