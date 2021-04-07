<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
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
                'unique:users,document,' . request()->route('user')->id,
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
                'unique:users,email,' . request()->route('user')->id,
            ],
            'phone'     => [
                'string',
                'required',
                'unique:users,phone,' . request()->route('user')->id,
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
        ];
    }
}
