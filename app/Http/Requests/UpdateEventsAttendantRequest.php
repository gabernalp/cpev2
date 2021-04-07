<?php

namespace App\Http\Requests;

use App\Models\EventsAttendant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventsAttendantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('events_attendant_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'last_name'     => [
                'string',
                'required',
            ],
            'documenttype'  => [
                'string',
                'required',
            ],
            'document'      => [
                'string',
                'required',
            ],
            'department_id' => [
                'required',
                'integer',
            ],
            'phone'         => [
                'string',
                'nullable',
            ],
            'email'         => [
                'string',
                'nullable',
            ],
        ];
    }
}
