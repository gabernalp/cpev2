@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.operator.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.operators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.id') }}
                        </th>
                        <td>
                            {{ $operator->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.name') }}
                        </th>
                        <td>
                            {{ $operator->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.nit') }}
                        </th>
                        <td>
                            {{ $operator->nit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.operator.fields.observaciones') }}
                        </th>
                        <td>
                            {{ $operator->observaciones }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.operators.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#operator_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#operator_contracts" role="tab" data-toggle="tab">
                {{ trans('cruds.contract.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#operators_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="operator_users">
            @includeIf('admin.operators.relationships.operatorUsers', ['users' => $operator->operatorUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="operator_contracts">
            @includeIf('admin.operators.relationships.operatorContracts', ['contracts' => $operator->operatorContracts])
        </div>
        <div class="tab-pane" role="tabpanel" id="operators_courses">
            @includeIf('admin.operators.relationships.operatorsCourses', ['courses' => $operator->operatorsCourses])
        </div>
    </div>
</div>

@endsection