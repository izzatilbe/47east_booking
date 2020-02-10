<div class="m-3">
    @can('staycation_booking_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.staycation-bookings.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.staycationBooking.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.staycationBooking.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-StaycationBooking">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.booked_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.customer.fields.first_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.accom') }}
                            </th>
                            <th>
                                {{ trans('cruds.accommodation.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.check_in') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.check_out') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.duration') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.quantity') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.room_charge') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.misc_charge') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.total_charge') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.package') }}
                            </th>
                            <th>
                                {{ trans('cruds.staycationBooking.fields.booking_status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staycationBookings as $key => $staycationBooking)
                            <tr data-entry-id="{{ $staycationBooking->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $staycationBooking->id ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->booked_by->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->booked_by->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->accom->name ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->accom->price ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->check_in ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->check_out ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->duration ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->room_charge ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->misc_charge ?? '' }}
                                </td>
                                <td>
                                    {{ $staycationBooking->total_charge ?? '' }}
                                </td>
                                <td>
                                    {{ App\StaycationBooking::PACKAGE_RADIO[$staycationBooking->package] ?? '' }}
                                </td>
                                <td>
                                    {{ App\StaycationBooking::BOOKING_STATUS_RADIO[$staycationBooking->booking_status] ?? '' }}
                                </td>
                                <td>
                                    @can('staycation_booking_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.staycation-bookings.show', $staycationBooking->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('staycation_booking_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.staycation-bookings.edit', $staycationBooking->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('staycation_booking_delete')
                                        <form action="{{ route('admin.staycation-bookings.destroy', $staycationBooking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('staycation_booking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.staycation-bookings.massDestroy') }}",
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
  $('.datatable-StaycationBooking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection