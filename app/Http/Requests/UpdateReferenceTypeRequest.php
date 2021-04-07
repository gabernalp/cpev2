<?php

namespace App\Http\Requests;

use App\Models\ReferenceType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReferenceTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reference_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
