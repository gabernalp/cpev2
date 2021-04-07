<?php

namespace App\Http\Requests;

use App\Models\SubcategoriesSet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubcategoriesSetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subcategories_set_edit');
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
