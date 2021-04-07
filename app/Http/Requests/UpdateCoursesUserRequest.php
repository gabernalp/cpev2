<?php

namespace App\Http\Requests;

use App\Models\CoursesUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCoursesUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('courses_user_edit');
    }

    public function rules()
    {
        return [
            'course_name'   => [
                'string',
                'required',
            ],
            'start_date_id' => [
                'required',
                'integer',
            ],
            'challenges'    => [
                'string',
                'nullable',
            ],
            'feedbacks'     => [
                'string',
                'nullable',
            ],
            'badges'        => [
                'string',
                'nullable',
            ],
        ];
    }
}
