<?php

namespace App\Http\Requests;

use App\Models\Operator;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOperatorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('operator_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:operators,id',
        ];
    }
}
