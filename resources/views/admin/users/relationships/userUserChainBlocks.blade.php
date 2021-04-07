@can('user_chain_block_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-chain-blocks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userChainBlock.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userChainBlock.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userUserChainBlocks">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.document') }}
                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.referencetype') }}
                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.media') }}
                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.text') }}
                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.broker') }}
                        </th>
                        <th>
                            {{ trans('cruds.userChainBlock.fields.id_mensaje') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userChainBlocks as $key => $userChainBlock)
                        <tr data-entry-id="{{ $userChainBlock->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userChainBlock->id ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->user->phone ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->user->document ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->referencetype->name ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->media ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->text ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->broker ?? '' }}
                            </td>
                            <td>
                                {{ $userChainBlock->id_mensaje ?? '' }}
                            </td>
                            <td>
                                @can('user_chain_block_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-chain-blocks.show', $userChainBlock->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_chain_block_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-chain-blocks.edit', $userChainBlock->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_chain_block_delete')
                                    <form action="{{ route('admin.user-chain-blocks.destroy', $userChainBlock->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_chain_block_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-chain-blocks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userUserChainBlocks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection