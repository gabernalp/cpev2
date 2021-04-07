<?php

namespace App\Http\Requests;

use App\Models\BackgroundProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBackgroundProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('background_process_create');
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
