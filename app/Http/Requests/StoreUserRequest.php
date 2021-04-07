<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'document'  => [
                'required',
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:users,document',
            ],
            'name'      => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email'     => [
                'required',
                'unique:users',
            ],
            'phone'     => [
                'string',
                'required',
                'unique:users',
            ],
            'phone_2'   => [
                'string',
                'nullable',
            ],
            'devices.*' => [
                'integer',
            ],
            'devices'   => [
                'array',
            ],
            'roles.*'   => [
                'integer',
            ],
            'roles'     => [
                'required',
                'array',
            ],
            'entity'    => [
                'string',
                'nullable',
            ],
            'password'  => [
                'required',
            ],
        ];
    }
}
