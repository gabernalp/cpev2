<?php

namespace App\Http\Requests;

use App\Models\ChallengesUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChallengesUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('challenges_user_create');
    }

    public function rules()
    {
        return [
            'reference_media' => [
                'string',
                'nullable',
            ],
            'file'            => [
                'required',
            ],
        ];
    }
}
