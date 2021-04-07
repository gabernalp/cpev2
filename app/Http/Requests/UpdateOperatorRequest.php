<?php

namespace App\Http\Requests;

use App\Models\Operator;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOperatorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('operator_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'nit'  => [
                'string',
                'nullable',
            ],
        ];
    }
}
