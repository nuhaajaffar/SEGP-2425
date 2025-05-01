<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'name',
        'ic',
        'category',
        'status',
    ];

    public function reports() {
        return $this->hasMany(PatientReport::class);
    }
    
    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
