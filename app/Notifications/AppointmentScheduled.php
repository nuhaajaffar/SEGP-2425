<?php
// app/Notifications/AppointmentScheduled.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentScheduled extends Notification
{
    use Queueable;

    protected Appointment $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $doctor    = $this->appointment->doctor;
        $patient   = $this->appointment->patient; // now pulled by username
        $when      = $this->appointment
                         ->appointment_date
                         ->format('Y-m-d H:i');

        // if patient relation somehow still null, use the raw full_name
        $patientName = $patient
                     ? $patient->name
                     : $this->appointment->full_name;

        if ($notifiable->id === $doctor->id) {
            $message = "New appointment booked with patient {$patientName} on {$when}.";
        } else {
            $message = "Your appointment with Dr. {$doctor->name} is set for {$when}.";
        }

        return [
            'message'        => $message,
            'appointment_id' => $this->appointment->id,
            'scheduled_at'   => $when,
        ];
    }
}
