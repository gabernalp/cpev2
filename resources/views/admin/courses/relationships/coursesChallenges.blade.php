@can('challenge_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.challenges.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.challenge.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.challenge.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-coursesChallenges">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.courses') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.goal') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.capsule') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.capsule_content') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.capsule_file') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.challenge_action') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.action_detail') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.limit_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.referencetype') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.hours_adding') }}
                        </th>
                        <th>
                            {{ trans('cruds.challenge.fields.points') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($challenges as $key => $challenge)
                        <tr data-entry-id="{{ $challenge->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $challenge->id ?? '' }}
                            </td>
                            <td>
                                @foreach($challenge->courses as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $challenge->name ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->description ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->goal ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->capsule ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->capsule_content ?? '' }}
                            </td>
                            <td>
                                @if($challenge->capsule_file)
                                    <a href="{{ $challenge->capsule_file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\Challenge::CHALLENGE_ACTION_SELECT[$challenge->challenge_action] ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->action_detail ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Challenge::LIMIT_TIME_SELECT[$challenge->limit_time] ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->referencetype->name ?? '' }}
                            </td>
                            <td>
                                {{ $challenge->hours_adding ?? '' }}
                            </td>
                            <td>
                                @foreach($challenge->points as $key => $item)
                                    <span class="badge badge-info">{{ $item->points_item }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('challenge_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.challenges.show', $challenge->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('challenge_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.challenges.edit', $challenge->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('challenge_delete')
                                    <form action="{{ route('admin.challenges.destroy', $challenge->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('challenge_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.challenges.massDestroy') }}",
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
  let table = $('.datatable-coursesChallenges:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection