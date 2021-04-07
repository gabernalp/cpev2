<?php

namespace App\Http\Requests;

use App\Models\BadgesUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBadgesUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('badges_user_edit');
    }

    public function rules()
    {
        return [
            'user_id'  => [
                'required',
                'integer',
            ],
            'badge_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
