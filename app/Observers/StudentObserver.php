<?php

namespace App\Observers;

use App\Models\Student;
use App\Mail\StudentChangesMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\StudentProfileUpdate;

class StudentObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = false;

    /**
     * Handle the Student "created" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        $message = 'Your profile has been successfully created on ' . env('APP_NAME') . '.';
        $subject = 'Your profile has been created';

        $this->notify($student, $message, $subject);
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        $message = 'Your profile has been successfully updated on ' . env('APP_NAME') . '.';
        $subject = 'Your profile has been modified';

        $this->notify($student, $message, $subject);
    }

    /**
     * Handle the Student "deleting" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleting(Student $student)
    {
        $message = 'Your profile has been successfully deleted on ' . env('APP_NAME') . '.';
        $subject = 'Your profile has been deleted';

        $this->notify($student, $message, $subject);
    }

    public function notify(Student $student, $message, $subject)
    {
        $student->notify(new StudentProfileUpdate($student, $message, $subject));
    }
}
