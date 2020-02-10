<div class="m-3">
    @can('coworking_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.coworkings.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.coworking.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.coworking.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Coworking">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.booked_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.customer.fields.first_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.date_start') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.date_end') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.duration') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.quantity') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.total_charge') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.booking_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.coworking.fields.pass_type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coworkings as $key => $coworking)
                            <tr data-entry-id="{{ $coworking->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $coworking->id ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->booked_by->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->booked_by->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->date_start ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->date_end ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->duration ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $coworking->total_charge ?? '' }}
                                </td>
                                <td>
                                    {{ App\Coworking::BOOKING_STATUS_RADIO[$coworking->booking_status] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Coworking::PASS_TYPE_RADIO[$coworking->pass_type] ?? '' }}
                                </td>
                                <td>
                                    @can('coworking_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.coworkings.show', $coworking->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('coworking_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.coworkings.edit', $coworking->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('coworking_delete')
                                        <form action="{{ route('admin.coworkings.destroy', $coworking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('coworking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.coworkings.massDestroy') }}",
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
  $('.datatable-Coworking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection