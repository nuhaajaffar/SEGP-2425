<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    // The table's primary key
    protected $primaryKey = 'id';

    // Fillable fields for mass-assignment
    protected $fillable = [
        'code',                // Human-readable hospital code (e.g., HSP-XYZ123)
        'name',                // Hospital name
        'address',             // Address of the hospital
        'pic_name',            // Person in Charge (PIC) Name
        'pic_contact',         // PIC contact number
        'secondary_contact',   // Secondary contact number
        'pic_username',        // PIC login username
        'pic_password',        // PIC login password (store hashed if used for login)
        'license',             // Hospital license document filename or license number
    ];

    /**
     * Relationship: Hospital has many associated users (staff)
     */
    public function users()
    {
        return $this->hasMany(HospitalUser::class, 'hospital_id');
    }

    /**
     * Relationship: Hospital has many patients
     */
    public function patients()
    {
        return $this->hasMany(\App\Models\Patient::class, 'hospital_code', 'code');
    }

    /**
     * Get only doctors
     */
    public function doctors()
    {
        return $this->users()->where('role', 'doctor');
    }

    /**
     * Get only radiologists
     */
    public function radiologists()
    {
        return $this->users()->where('role', 'radiologist');
    }

    /**
     * Get only radiographers
     */
    public function radiographers()
    {
        return $this->users()->where('role', 'radiographer');
    }

    /**
     * Automatically hash the PIC password if updated.
     */
    public function setPicPasswordAttribute($value)
    {
        $this->attributes['pic_password'] = bcrypt($value);
    }
}
