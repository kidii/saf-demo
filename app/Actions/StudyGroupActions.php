<?php

namespace App\Actions;

use Inertia\Inertia;
use App\Models\Student;
use App\Models\StudyGroup;
use App\Http\Resources\StudyGroupsResource;
use App\Http\Requests\StoreStudyGroupRequest;
use App\Http\Requests\UpdateStudyGroupRequest;

class StudyGroupActions
{
    public function showAllStudyGroups($requestData)
    {
        $search = $requestData->only(['search']);

        return Inertia::render('StudyGroups/Index', [
            'filters' => $search,
            'studyGroups' => StudyGroupsResource::collection(
                StudyGroup::query()
                    ->withCount('students')
                    ->orderByDesc('id')
                    ->searchByName($search)
                    ->paginate(StudyGroup::PAGINATED_ITEMS)
                    ->onEachSide(1)
                    ->withQueryString()
            ),
        ]);
    }

    public function storeStudyGroup(StoreStudyGroupRequest $request)
    {
        $validated = $request->validated();

        $studyGroup = new StudyGroup();
        $studyGroup->name = $validated['name'];
        $studyGroup->subject = $validated['subject'];
        $studyGroup->leader = $validated['leader'];
        $studyGroup->beginning_at = $validated['beginningAt'];

        $studyGroup->save();

        return $studyGroup;
    }

    public function updateStudyGroup(UpdateStudyGroupRequest $request, StudyGroup $studyGroup)
    {
        $validated = $request->validated();

        $studyGroup->name = $validated['name'];
        $studyGroup->subject = $validated['subject'];
        $studyGroup->leader = $validated['leader'];
        $studyGroup->beginning_at = $validated['beginningAt'];

        $studyGroup->update();

        return $studyGroup;
    }

    public function deleteStudyGroup(StudyGroup $studyGroup)
    {
        $studyGroupName = $studyGroup->name;

        $studyGroup->students()->detach(Student::all()->pluck('id'));
        $studyGroup->delete();

        return $studyGroupName;
    }
}