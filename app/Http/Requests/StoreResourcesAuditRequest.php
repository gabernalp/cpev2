<?php

namespace App\Http\Requests;

use App\Models\ResourcesAudit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResourcesAuditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('resources_audit_create');
    }

    public function rules()
    {
        return [
            'ip' => [
                'string',
                'nullable',
            ],
        ];
    }
}
