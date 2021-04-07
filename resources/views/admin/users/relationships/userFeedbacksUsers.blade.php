@can('feedbacks_user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.feedbacks-users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.feedbacksUser.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.feedbacksUser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userFeedbacksUsers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.programmed_course') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.document') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.feedbacktype') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.referencetype') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.file') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.feedbacksUser.fields.link') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacksUsers as $key => $feedbacksUser)
                        <tr data-entry-id="{{ $feedbacksUser->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $feedbacksUser->id ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->programmed_course->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->user->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->user->document ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->feedbacktype->name ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->referencetype->name ?? '' }}
                            </td>
                            <td>
                                @if($feedbacksUser->file)
                                    <a href="{{ $feedbacksUser->file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $feedbacksUser->description ?? '' }}
                            </td>
                            <td>
                                {{ $feedbacksUser->link ?? '' }}
                            </td>
                            <td>
                                @can('feedbacks_user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.feedbacks-users.show', $feedbacksUser->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('feedbacks_user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.feedbacks-users.edit', $feedbacksUser->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('feedbacks_user_delete')
                                    <form action="{{ route('admin.feedbacks-users.destroy', $feedbacksUser->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('feedbacks_user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.feedbacks-users.massDestroy') }}",
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
  let table = $('.datatable-userFeedbacksUsers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection