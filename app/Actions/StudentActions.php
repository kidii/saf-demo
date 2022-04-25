<?php

namespace App\Actions;

use Inertia\Inertia;
use App\Models\Student;
use App\Models\StudyGroup;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\StudentsResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudyGroupsResource;

class StudentActions
{
    public function showAllStudents($requestData)
    {
        $search = $requestData->only(['search']);

        return Inertia::render('Students/Index', [
            'filters' => $search,
            'studyGroups' => StudyGroupsResource::collection(StudyGroup::all()),
            'students' => StudentsResource::collection(
                Student::query()
                    ->orderByDesc('id')
                    ->searchByName($search)
                    ->paginate(Student::PAGINATED_ITEMS)
                    ->onEachSide(1)
                    ->withQueryString()
            ),
        ]);
    }

    public function storeStudent(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        $student = new Student();
        $student->name = $validated['name'];
        $student->sex = $validated['sex'];
        $student->email = $validated['email'];
        $student->place_of_birth = $validated['placeOfBirth'];
        $student->date_of_birth = $validated['dateOfBirth'];

        $student->save();

        $student->studyGroups()->sync($validated['selectedStudyGroup']);

        return $student;
    }

    public function updateStudent(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();

        $student->name = $validated['name'];
        $student->sex = $validated['sex'];
        $student->email = $validated['email'];
        $student->place_of_birth = $validated['placeOfBirth'];
        $student->date_of_birth = $validated['dateOfBirth'];

        $student->update();

        $student->studyGroups()->sync($validated['selectedStudyGroup']);

        return $student;
    }

    public function deleteStudent(Student $student)
    {
        $studentName = $student->name;
        $student->studyGroups()->detach();
        $student->delete();

        return $studentName;
    }
}