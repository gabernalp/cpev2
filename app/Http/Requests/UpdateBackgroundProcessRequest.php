<?php

namespace App\Http\Requests;

use App\Models\BackgroundProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBackgroundProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('background_process_edit');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'tags.*'      => [
                'integer',
            ],
            'tags'        => [
                'array',
            ],
        ];
    }
}
