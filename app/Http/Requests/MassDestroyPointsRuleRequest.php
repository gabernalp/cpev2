<?php

namespace App\Http\Requests;

use App\Models\PointsRule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPointsRuleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('points_rule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:points_rules,id',
        ];
    }
}
