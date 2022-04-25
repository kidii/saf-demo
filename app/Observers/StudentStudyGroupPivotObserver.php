<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\StudyGroup;
use Illuminate\Support\Facades\Mail;
use App\Models\StudentStudyGroupPivot;
use App\Mail\StudentStudyGroupChangesMail;
use App\Notifications\StudentStudyGroupUpdate;

class StudentStudyGroupPivotObserver
{
    /**
     * Handle the StudentStudyGroup pivot "created" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function created(StudentStudyGroupPivot $studentStudyGroup)
    {
        $student = $this->getStudentInfo($studentStudyGroup->student_id);
        $studyGroup = $this->getStudyGroupInfo($studentStudyGroup->study_group_id);

        $message = 'You have been successfully added to the following study group: ' . $studyGroup->name . '.';
        $subject = 'You have been successfully added to a study group';

        $this->notify($student, $message, $subject);
    }

    /**
     * Handle the StudentStudyGroup pivot "deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleted(StudentStudyGroupPivot $studentStudyGroup)
    {
        $student = $this->getStudentInfo($studentStudyGroup->student_id);
        $studyGroup = $this->getStudyGroupInfo($studentStudyGroup->study_group_id);

        $message = 'You have been removed from the following study group: ' . $studyGroup->name . '.';
        $subject = 'You have been removed from a study group';

        $this->notify($student, $message, $subject);
    }

    public function getStudentInfo($studentId)
    {
        return $student = Student::find($studentId);
    }

    public function getStudyGroupInfo($studyGroupId)
    {
        return $studyGroup = StudyGroup::find($studyGroupId);
    }

    public function notify(Student $student, $message, $subject)
    {
        $student->notify(new StudentStudyGroupUpdate($student, $message, $subject));
    }
}
