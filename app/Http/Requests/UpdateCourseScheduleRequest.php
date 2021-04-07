<?php

namespace App\Http\Requests;

use App\Models\CourseSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_schedule_edit');
    }

    public function rules()
    {
        return [
            'course_id'      => [
                'required',
                'integer',
            ],
            'start_date'     => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tutors.*'       => [
                'integer',
            ],
            'tutors'         => [
                'required',
                'array',
            ],
            'tutor_capacity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
