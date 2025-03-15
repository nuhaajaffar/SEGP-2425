<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    use HasFactory;

    protected $fillable = ['hospital_user_id', 'report_path'];

    public function patient()
    {
        return $this->belongsTo(\App\Models\HospitalUser::class, 'hospital_user_id');
    }
}
