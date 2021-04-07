<?php

namespace App\Http\Requests;

use App\Models\Meeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('meeting_edit');
    }

    public function rules()
    {
        return [
            'title'         => [
                'string',
                'nullable',
            ],
            'departments.*' => [
                'integer',
            ],
            'departments'   => [
                'array',
            ],
            'tags.*'        => [
                'integer',
            ],
            'tags'          => [
                'array',
            ],
            'date'          => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time'          => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'link'          => [
                'string',
                'nullable',
            ],
        ];
    }
}
