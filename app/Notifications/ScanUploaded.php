<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\HospitalUser;

class ScanUploaded extends Notification
{
    use Queueable;

    protected HospitalUser $radiographer;
    protected HospitalUser $patient;

    public function __construct(HospitalUser $radiographer, HospitalUser $patient)
    {
        $this->radiographer = $radiographer;
        $this->patient      = $patient;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message'            => "Radiographer {$this->radiographer->name} has uploaded a scan for {$this->patient->name}.",
            'radiographer_id'    => $this->radiographer->id,
            'patient_id'         => $this->patient->id,
        ];
    }
}
