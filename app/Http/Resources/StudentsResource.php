<?php

namespace App\Http\Resources;

use App\Enums\StudentSex;
use App\Http\Resources\StudyGroupsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatarUrl(),
            'name' => $this->name,
            'sex' => StudentSex::tryFrom($this->sex->value)->name,
            'birthData' => $this->birthData(),
            'inStudyGroups' => StudyGroupsResource::collection($this->studyGroups)
        ];
    }
}
