<?php

namespace App\Http\Requests;

use App\Models\SubcategoriesSet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubcategoriesSetRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subcategories_set_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:subcategories_sets,id',
        ];
    }
}
