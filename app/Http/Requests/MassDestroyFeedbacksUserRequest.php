<?php

namespace App\Http\Requests;

use App\Models\FeedbacksUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFeedbacksUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('feedbacks_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:feedbacks_users,id',
        ];
    }
}
