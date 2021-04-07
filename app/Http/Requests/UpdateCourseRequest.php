<?php

namespace App\Http\Requests;

use App\Models\Course;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_edit');
    }

    public function rules()
    {
        return [
            'associated_processes.*'      => [
                'integer',
            ],
            'associated_processes'        => [
                'required',
                'array',
            ],
            'name'                        => [
                'string',
                'required',
            ],
            'description'                 => [
                'required',
            ],
            'goal'                        => [
                'required',
            ],
            'roles.*'                     => [
                'integer',
            ],
            'roles'                       => [
                'required',
                'array',
            ],
            'focalizacion_territorials.*' => [
                'integer',
            ],
            'focalizacion_territorials'   => [
                'required',
                'array',
            ],
            'hours'                       => [
                'string',
                'nullable',
            ],
            'operators.*'                 => [
                'integer',
            ],
            'operators'                   => [
                'array',
            ],
            'references.*'                => [
                'integer',
            ],
            'references'                  => [
                'array',
            ],
            'courseshooks.*'              => [
                'integer',
            ],
            'courseshooks'                => [
                'array',
            ],
        ];
    }
}
