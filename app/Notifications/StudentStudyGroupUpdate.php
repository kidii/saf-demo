<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use App\Mail\StudentStudyGroupChangesMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentStudyGroupUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    public $student;
    public $message;
    public $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Student $student, string $message, string $subject)
    {
        $this->student = $student;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new StudentStudyGroupChangesMail([
            'studentName' => $this->student->name,
            'message' => $this->message,
            'subject' => $this->subject,
        ]))->to($notifiable->email);
    }
}
