<?php

namespace App\Http\Requests;

use App\Models\PointsRule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointsRuleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('points_rule_create');
    }

    public function rules()
    {
        return [
            'points_item' => [
                'string',
                'required',
            ],
            'points'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
