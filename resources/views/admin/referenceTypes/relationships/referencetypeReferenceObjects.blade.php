@can('reference_object_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.reference-objects.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.referenceObject.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.referenceObject.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-referencetypeReferenceObjects">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.referencetype') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.file') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.tags') }}
                        </th>
                        <th>
                            {{ trans('cruds.referenceObject.fields.comments') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($referenceObjects as $key => $referenceObject)
                        <tr data-entry-id="{{ $referenceObject->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $referenceObject->id ?? '' }}
                            </td>
                            <td>
                                {{ $referenceObject->referencetype->name ?? '' }}
                            </td>
                            <td>
                                {{ $referenceObject->title ?? '' }}
                            </td>
                            <td>
                                {{ $referenceObject->link ?? '' }}
                            </td>
                            <td>
                                @if($referenceObject->file)
                                    <a href="{{ $referenceObject->file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $referenceObject->image ?? '' }}
                            </td>
                            <td>
                                @foreach($referenceObject->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $referenceObject->comments ?? '' }}
                            </td>
                            <td>
                                @can('reference_object_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.reference-objects.show', $referenceObject->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('reference_object_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.reference-objects.edit', $referenceObject->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('reference_object_delete')
                                    <form action="{{ route('admin.reference-objects.destroy', $referenceObject->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('reference_object_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.reference-objects.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-referencetypeReferenceObjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection