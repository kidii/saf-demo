<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentStudyGroupPivot extends Pivot
{
    protected $table = 'student_study_group';
}
