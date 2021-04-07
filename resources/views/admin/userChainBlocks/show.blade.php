@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userChainBlock.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-chain-blocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.id') }}
                        </th>
                        <td>
                            {{ $userChainBlock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.user') }}
                        </th>
                        <td>
                            {{ $userChainBlock->user->phone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.referencetype') }}
                        </th>
                        <td>
                            {{ $userChainBlock->referencetype->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.media') }}
                        </th>
                        <td>
                            {{ $userChainBlock->media }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.text') }}
                        </th>
                        <td>
                            {{ $userChainBlock->text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.broker') }}
                        </th>
                        <td>
                            {{ $userChainBlock->broker }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.id_mensaje') }}
                        </th>
                        <td>
                            {{ $userChainBlock->id_mensaje }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-chain-blocks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection