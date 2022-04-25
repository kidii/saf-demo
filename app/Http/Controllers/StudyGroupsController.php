<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Student;
use App\Models\StudyGroup;
use App\Actions\StudyGroupActions;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\StudentsResource;
use App\Http\Resources\StudyGroupsResource;
use App\Http\Requests\StoreStudyGroupRequest;
use App\Http\Requests\UpdateStudyGroupRequest;

class StudyGroupsController extends Controller
{
    public function __construct(protected StudyGroupActions $action)
    {
        $this->action = $action;
    }

    public function index()
    {
        return $this->action->showAllStudyGroups(request());
    }

    public function create()
    {
        return Inertia::render('StudyGroups/Create', [
            'students' => StudentsResource::collection(Student::all()),
        ]);
    }

    public function store(StoreStudyGroupRequest $request)
    {
        $createdStudyGroup = $this->action->storeStudyGroup($request);

        return redirect()->route('study-groups.index')
                         ->with('success', $createdStudyGroup->name . ' has been successfully created.');
    }

    public function edit(StudyGroup $studyGroup)
    {
        return Inertia::render('StudyGroups/Edit', [
            'studyGroup' => new StudyGroupsResource($studyGroup)
        ]);
    }

    public function update(UpdateStudyGroupRequest $request, StudyGroup $studyGroup)
    {
        $updatedStudyGroup = $this->action->updateStudyGroup($request, $studyGroup);

        return redirect()->back()
                         ->with('success', $studyGroup->name . ' has been successfully updated.');
    }

    public function destroy(StudyGroup $studyGroup)
    {
        $deletedStudyGroupName = $this->action->deleteStudyGroup($studyGroup);

        return redirect()->route('study-groups.index')
                         ->with('success', $deletedStudyGroupName . ' has been successfully deleted.');
    }
}
