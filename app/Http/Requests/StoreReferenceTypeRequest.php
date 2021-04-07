<?php

namespace App\Http\Requests;

use App\Models\ReferenceType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReferenceTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reference_type_create');
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
