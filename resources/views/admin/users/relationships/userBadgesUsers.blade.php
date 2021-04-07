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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userBadgesUsers">
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
                <tbody>
                    @foreach($badgesUsers as $key => $badgesUser)
                        <tr data-entry-id="{{ $badgesUser->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $badgesUser->id ?? '' }}
                            </td>
                            <td>
                                {{ $badgesUser->programmed_course->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $badgesUser->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $badgesUser->user->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $badgesUser->user->document ?? '' }}
                            </td>
                            <td>
                                {{ $badgesUser->badge->name ?? '' }}
                            </td>
                            <td>
                                {{ $badgesUser->badge->points ?? '' }}
                            </td>
                            <td>
                                @can('badges_user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.badges-users.show', $badgesUser->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('badges_user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.badges-users.edit', $badgesUser->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('badges_user_delete')
                                    <form action="{{ route('admin.badges-users.destroy', $badgesUser->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('badges_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.badges-users.massDestroy') }}",
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
    pageLength: 50,
  });
  let table = $('.datatable-userBadgesUsers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection