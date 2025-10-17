<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentAdminNotification extends Notification
{
    use Queueable;
    public $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
       $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'user_name'      => $this->appointment->user->name ?? 'Unknown',
            'user_email'     => $this->appointment->user->email ?? '',
            'service'        => $this->appointment->service ?? '',
            'message'        => 'এর একটি নতুন Appointment বুক করা হয়েছে!',
        ];
    }
}
