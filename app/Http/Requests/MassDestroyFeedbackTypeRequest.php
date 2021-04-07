<?php

namespace App\Http\Requests;

use App\Models\FeedbackType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFeedbackTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('feedback_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:feedback_types,id',
        ];
    }
}
