@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserChainBlock">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_chain_block_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-chain-blocks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.user-chain-blocks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_phone', name: 'user.phone' },
{ data: 'user.document', name: 'user.document' },
{ data: 'referencetype_name', name: 'referencetype.name' },
{ data: 'media', name: 'media' },
{ data: 'text', name: 'text' },
{ data: 'broker', name: 'broker' },
{ data: 'id_mensaje', name: 'id_mensaje' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-UserChainBlock').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection