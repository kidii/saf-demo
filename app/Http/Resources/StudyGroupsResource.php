<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudyGroupsResource extends JsonResource
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
            $this->mergeWhen($request->routeIs('study-groups.*'), [
                'studentsCount' => $this->students_count,
                'subject' => $this->subject,
                'leader' => $this->leader,
                'beginningAt' => $this->beginning_at,
                'beginningAtParsed' => $this->beginning_at->format('Y.m.d H:i:s')
            ]),
        ];
    }
}
