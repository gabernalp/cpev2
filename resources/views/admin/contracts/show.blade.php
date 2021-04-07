@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contract.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contracts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.id') }}
                        </th>
                        <td>
                            {{ $contract->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.name') }}
                        </th>
                        <td>
                            {{ $contract->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.start_date') }}
                        </th>
                        <td>
                            {{ $contract->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.end_date') }}
                        </th>
                        <td>
                            {{ $contract->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.operator') }}
                        </th>
                        <td>
                            {{ $contract->operator->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.entity') }}
                        </th>
                        <td>
                            @foreach($contract->entities as $key => $entity)
                                <span class="label label-info">{{ $entity->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contracts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection