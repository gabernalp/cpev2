<?php

namespace App\Http\Requests;

use App\Models\Badge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBadgeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('badge_edit');
    }

    public function rules()
    {
        return [
            'name'   => [
                'string',
                'required',
            ],
            'points' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
