<?php

namespace App\Http\Resources;

use App\Enums\StudentSex;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'sex' => StudentSex::tryFrom($this->sex->value),
            'placeOfBirth' => $this->place_of_birth,
            'dateOfBirth' => $this->date_of_birth,
            'inStudyGroupsIds' => $this->studyGroups->pluck('id'),
        ];
    }
}
