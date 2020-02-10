@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.venueBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $venueBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.booked_by') }}
                        </th>
                        <td>
                            {{ $venueBooking->booked_by->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.datetime_start') }}
                        </th>
                        <td>
                            {{ $venueBooking->datetime_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.datetime_end') }}
                        </th>
                        <td>
                            {{ $venueBooking->datetime_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.duration') }}
                        </th>
                        <td>
                            {{ $venueBooking->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.room_charge') }}
                        </th>
                        <td>
                            {{ $venueBooking->room_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.misc_charge') }}
                        </th>
                        <td>
                            {{ $venueBooking->misc_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.total_charge') }}
                        </th>
                        <td>
                            {{ $venueBooking->total_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.payment_type') }}
                        </th>
                        <td>
                            {{ App\VenueBooking::PAYMENT_TYPE_RADIO[$venueBooking->payment_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueBooking.fields.booking_status') }}
                        </th>
                        <td>
                            {{ App\VenueBooking::BOOKING_STATUS_RADIO[$venueBooking->booking_status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#venue_venue_packages" role="tab" data-toggle="tab">
                {{ trans('cruds.venuePackage.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="venue_venue_packages">
            @includeIf('admin.venueBookings.relationships.venueVenuePackages', ['venuePackages' => $venueBooking->venueVenuePackages])
        </div>
    </div>
</div>

@endsection