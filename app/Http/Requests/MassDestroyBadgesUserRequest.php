<?php

namespace App\Http\Requests;

use App\Models\BadgesUser;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBadgesUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('badges_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:badges_users,id',
        ];
    }
}
