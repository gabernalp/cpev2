<?php

namespace App\Http\Requests;

use App\Models\CoursesHook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCoursesHookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('courses_hook_edit');
    }

    public function rules()
    {
        return [
            'name'              => [
                'string',
                'required',
            ],
            'specific_category' => [
                'string',
                'nullable',
            ],
            'entities.*'        => [
                'integer',
            ],
            'entities'          => [
                'array',
            ],
            'departments.*'     => [
                'integer',
            ],
            'departments'       => [
                'array',
            ],
            'link'              => [
                'string',
                'nullable',
            ],
        ];
    }
}
