<?php

namespace App\Http\Requests;

use App\Models\UserChainBlock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserChainBlockRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_chain_block_create');
    }

    public function rules()
    {
        return [];
    }
}
