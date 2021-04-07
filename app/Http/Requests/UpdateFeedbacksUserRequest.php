<?php

namespace App\Http\Requests;

use App\Models\FeedbacksUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFeedbacksUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feedbacks_user_edit');
    }

    public function rules()
    {
        return [
            'user_id'          => [
                'required',
                'integer',
            ],
            'feedbacktype_id'  => [
                'required',
                'integer',
            ],
            'referencetype_id' => [
                'required',
                'integer',
            ],
            'link'             => [
                'string',
                'nullable',
            ],
        ];
    }
}
