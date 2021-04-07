<?php

namespace App\Http\Requests;

use App\Models\ReferenceObject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReferenceObjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reference_object_create');
    }

    public function rules()
    {
        return [
            'title'    => [
                'string',
                'nullable',
            ],
            'link'     => [
                'string',
                'nullable',
            ],
            'image'    => [
                'string',
                'nullable',
            ],
            'tags.*'   => [
                'integer',
            ],
            'tags'     => [
                'array',
            ],
            'comments' => [
                'string',
                'nullable',
            ],
        ];
    }
}
