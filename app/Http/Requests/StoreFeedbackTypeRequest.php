<?php

namespace App\Http\Requests;

use App\Models\FeedbackType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeedbackTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feedback_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
