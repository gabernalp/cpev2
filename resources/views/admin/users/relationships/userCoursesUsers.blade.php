@can('courses_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.courses-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.coursesUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.coursesUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userCoursesUsers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.document') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.course_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.challenges') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.feedbacks') }}
                        </th>
                        <th>
                            {{ trans('cruds.coursesUser.fields.badges') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coursesUsers as $key => $coursesUser)
                        <tr data-entry-id="{{ $coursesUser->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $coursesUser->id ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->user->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->user->document ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->course_name ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->group ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->start_date->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->end_date ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->challenges ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->feedbacks ?? '' }}
                            </td>
                            <td>
                                {{ $coursesUser->badges ?? '' }}
                            </td>
                            <td>
                                @can('courses_user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.courses-users.show', $coursesUser->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('courses_user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.courses-users.edit', $coursesUser->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('courses_user_delete')
                                    <form action="{{ route('admin.courses-users.destroy', $coursesUser->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('courses_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.courses-users.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-userCoursesUsers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection