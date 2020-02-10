@extends('layouts.admin')
@section('content')
@can('dormitory_booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.dormitory-bookings.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.dormitoryBooking.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dormitoryBooking.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DormitoryBooking">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.accom') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.booked_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.duration_months') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.move_in') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.room_charge') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.misc_charge') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.total_charge') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.booking_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.payment_type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dormitoryBookings as $key => $dormitoryBooking)
                        <tr data-entry-id="{{ $dormitoryBooking->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dormitoryBooking->id ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->accom->name ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->accom->price ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->booked_by->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->booked_by->first_name ?? '' }}
                            </td>
                            <td>
                                {{ App\DormitoryBooking::DURATION_MONTHS_RADIO[$dormitoryBooking->duration_months] ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->move_in ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->room_charge ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->misc_charge ?? '' }}
                            </td>
                            <td>
                                {{ $dormitoryBooking->total_charge ?? '' }}
                            </td>
                            <td>
                                {{ App\DormitoryBooking::BOOKING_STATUS_RADIO[$dormitoryBooking->booking_status] ?? '' }}
                            </td>
                            <td>
                                {{ App\DormitoryBooking::PAYMENT_TYPE_RADIO[$dormitoryBooking->payment_type] ?? '' }}
                            </td>
                            <td>
                                @can('dormitory_booking_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.dormitory-bookings.show', $dormitoryBooking->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dormitory_booking_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.dormitory-bookings.edit', $dormitoryBooking->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dormitory_booking_delete')
                                    <form action="{{ route('admin.dormitory-bookings.destroy', $dormitoryBooking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('dormitory_booking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.dormitory-bookings.massDestroy') }}",
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
  $('.datatable-DormitoryBooking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection