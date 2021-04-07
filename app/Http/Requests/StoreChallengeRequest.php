<?php

namespace App\Http\Requests;

use App\Models\Challenge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChallengeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('challenge_create');
    }

    public function rules()
    {
        return [
            'courses.*'        => [
                'integer',
            ],
            'courses'          => [
                'array',
            ],
            'name'             => [
                'string',
                'required',
            ],
            'description'      => [
                'string',
                'nullable',
            ],
            'capsule'          => [
                'string',
                'nullable',
            ],
            'referencetype_id' => [
                'required',
                'integer',
            ],
            'hours_adding'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'points.*'         => [
                'integer',
            ],
            'points'           => [
                'array',
            ],
        ];
    }
}
