<?php

namespace App\Http\Requests;

use App\Enums\StudentSex;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'sex' => ['required', new Enum(StudentSex::class)],
            'email' => 'required|email|unique:students,email,' . $this->student->id,
            'placeOfBirth' => 'required|string|min:3',
            'dateOfBirth' => 'required|date',
            'selectedStudyGroup' => 'exists:study_groups,id|max:4'
        ];
    }
}
