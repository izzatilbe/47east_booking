@extends('layouts.admin')
@section('content')
@can('venue_booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.venue-bookings.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.venueBooking.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.venueBooking.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-VenueBooking">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.booked_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.datetime_start') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.datetime_end') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.room_charge') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.misc_charge') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.total_charge') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.payment_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.venueBooking.fields.booking_status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venueBookings as $key => $venueBooking)
                        <tr data-entry-id="{{ $venueBooking->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $venueBooking->id ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->booked_by->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->booked_by->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->datetime_start ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->datetime_end ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->duration ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->room_charge ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->misc_charge ?? '' }}
                            </td>
                            <td>
                                {{ $venueBooking->total_charge ?? '' }}
                            </td>
                            <td>
                                {{ App\VenueBooking::PAYMENT_TYPE_RADIO[$venueBooking->payment_type] ?? '' }}
                            </td>
                            <td>
                                {{ App\VenueBooking::BOOKING_STATUS_RADIO[$venueBooking->booking_status] ?? '' }}
                            </td>
                            <td>
                                @can('venue_booking_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.venue-bookings.show', $venueBooking->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('venue_booking_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.venue-bookings.edit', $venueBooking->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('venue_booking_delete')
                                    <form action="{{ route('admin.venue-bookings.destroy', $venueBooking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('venue_booking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.venue-bookings.massDestroy') }}",
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
  $('.datatable-VenueBooking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection