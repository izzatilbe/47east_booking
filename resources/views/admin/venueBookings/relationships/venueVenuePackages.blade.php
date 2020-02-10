<div class="m-3">
    @can('venue_package_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.venue-packages.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.venuePackage.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.venuePackage.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-VenuePackage">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.venuePackage.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.venuePackage.fields.accom') }}
                            </th>
                            <th>
                                {{ trans('cruds.venuePackage.fields.venue') }}
                            </th>
                            <th>
                                {{ trans('cruds.venuePackage.fields.total_package_charge') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venuePackages as $key => $venuePackage)
                            <tr data-entry-id="{{ $venuePackage->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $venuePackage->id ?? '' }}
                                </td>
                                <td>
                                    @foreach($venuePackage->accoms as $key => $item)
                                        <span class="badge badge-info">{{ $item->total_charge }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($venuePackage->venues as $key => $item)
                                        <span class="badge badge-info">{{ $item->room_charge }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $venuePackage->total_package_charge ?? '' }}
                                </td>
                                <td>
                                    @can('venue_package_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.venue-packages.show', $venuePackage->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('venue_package_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.venue-packages.edit', $venuePackage->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('venue_package_delete')
                                        <form action="{{ route('admin.venue-packages.destroy', $venuePackage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('venue_package_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.venue-packages.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-VenuePackage:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection