@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'User', 'route' => 'admin.users.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.documenttype') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.document') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.phone_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.zona') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.etnia') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.academic_background') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.devices') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.place_role') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.labour_role') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.modality') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.operator') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.newsletter_subscription') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.motivation') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.experience') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.verified') }}
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
    ajax: "{{ route('admin.users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'documenttype_name', name: 'documenttype.name' },
{ data: 'document', name: 'document' },
{ data: 'name', name: 'name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'gender', name: 'gender' },
{ data: 'email', name: 'email' },
{ data: 'phone', name: 'phone' },
{ data: 'phone_2', name: 'phone_2' },
{ data: 'department_name', name: 'department.name' },
{ data: 'city_name', name: 'city.name' },
{ data: 'zona', name: 'zona' },
{ data: 'etnia', name: 'etnia' },
{ data: 'academic_background', name: 'academic_background' },
{ data: 'devices', name: 'devices.name' },
{ data: 'roles', name: 'roles.title' },
{ data: 'place_role', name: 'place_role' },
{ data: 'labour_role', name: 'labour_role' },
{ data: 'modality', name: 'modality' },
{ data: 'entity', name: 'entity' },
{ data: 'operator_name', name: 'operator.name' },
{ data: 'newsletter_subscription', name: 'newsletter_subscription' },
{ data: 'motivation', name: 'motivation' },
{ data: 'experience', name: 'experience' },
{ data: 'email_verified_at', name: 'email_verified_at' },
{ data: 'verified', name: 'verified' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-User').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection