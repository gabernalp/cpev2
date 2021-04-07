<?php

namespace App\Http\Requests;

use App\Models\SelfInterestedUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSelfInterestedUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('self_interested_user_create');
    }

    public function rules()
    {
        return [
            'name'                 => [
                'string',
                'required',
            ],
            'lastname'             => [
                'string',
                'required',
            ],
            'email'                => [
                'required',
            ],
            'documenttype_id'      => [
                'required',
                'integer',
            ],
            'document'             => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'document_date'        => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'phone'                => [
                'string',
                'nullable',
            ],
            'education_background' => [
                'required',
            ],
            'modality'             => [
                'required',
            ],
            'living_zone'          => [
                'required',
            ],
            'courseshooks.*'       => [
                'integer',
            ],
            'courseshooks'         => [
                'array',
            ],
        ];
    }
}
