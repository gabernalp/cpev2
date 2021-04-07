<?php

namespace App\Http\Requests;

use App\Models\ChallengesUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChallengesUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('challenges_user_edit');
    }

    public function rules()
    {
        return [
            'reference_media' => [
                'string',
                'nullable',
            ],
        ];
    }
}
