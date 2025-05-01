<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\HospitalUser;

class ReportCompleted extends Notification
{
    use Queueable;

    protected HospitalUser $radiologist;
    protected HospitalUser $patient;

    public function __construct(HospitalUser $radiologist, HospitalUser $patient)
    {
        $this->radiologist = $radiologist;
        $this->patient     = $patient;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message'        => "Radiologist {$this->radiologist->name} has completed work for {$this->patient->name}.",
            'radiologist_id' => $this->radiologist->id,
            'patient_id'     => $this->patient->id,
        ];
    }
}
