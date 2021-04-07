@extends('layouts.admin')
@section('content')
@can('badges_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.badges-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.badgesUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.badgesUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BadgesUser">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.badgesUser.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.badgesUser.fields.programmed_course') }}
                    </th>
                    <th>
                        {{ trans('cruds.badgesUser.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.document') }}
                    </th>
                    <th>
                        {{ trans('cruds.badgesUser.fields.badge') }}
                    </th>
                    <th>
                        {{ trans('cruds.badge.fields.points') }}
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
@can('badges_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.badges-users.massDestroy') }}",
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
    ajax: "{{ route('admin.badges-users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'programmed_course_start_date', name: 'programmed_course.start_date' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.last_name', name: 'user.last_name' },
{ data: 'user.document', name: 'user.document' },
{ data: 'badge_name', name: 'badge.name' },
{ data: 'badge.points', name: 'badge.points' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-BadgesUser').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection