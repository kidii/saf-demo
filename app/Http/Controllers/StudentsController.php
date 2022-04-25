<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Student;
use App\Enums\StudentSex;
use App\Models\StudyGroup;
use App\Actions\StudentActions;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudyGroupsResource;

class StudentsController extends Controller
{
    public function __construct(protected StudentActions $action)
    {
        $this->action = $action;
    }

    public function index()
    {
        return $this->action->showAllStudents(request());
    }

    public function create()
    {
        return Inertia::render('Students/Create', [
            'studentSex' => StudentSex::array(),
            'studyGroups' => StudyGroupsResource::collection(StudyGroup::all()),
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $createdStudent = $this->action->storeStudent($request);

        return redirect()->route('students.index')
                         ->with('success', $createdStudent->name . ' profile has been successfully created.');
    }

    public function edit(Student $student)
    {
        return Inertia::render('Students/Edit', [
            'studyGroups' => StudyGroupsResource::collection(StudyGroup::all()),
            'studentSex' => StudentSex::array(),
            'student' => new StudentResource($student)
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $updatedStudent = $this->action->updateStudent($request, $student);

        return redirect()->back()
                         ->with('success', $updatedStudent->name . ' profile has been successfully updated.');
    }

    public function destroy(Student $student)
    {
        $deletedStudentName = $this->action->deleteStudent($student);

        return redirect()->route('students.index')
                         ->with('success', $deletedStudentName . ' profile has been successfully deleted.');
    }
}
