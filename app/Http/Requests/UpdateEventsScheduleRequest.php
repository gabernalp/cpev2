<?php

namespace App\Http\Requests;

use App\Models\EventsSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventsScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('events_schedule_edit');
    }

    public function rules()
    {
        return [
            'title'       => [
                'string',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'date'        => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'link'        => [
                'string',
                'nullable',
            ],
            'invitados'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
