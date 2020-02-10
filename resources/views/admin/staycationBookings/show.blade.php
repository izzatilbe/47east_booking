@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.staycationBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.staycation-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $staycationBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.booked_by') }}
                        </th>
                        <td>
                            {{ $staycationBooking->booked_by->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.accom') }}
                        </th>
                        <td>
                            {{ $staycationBooking->accom->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.check_in') }}
                        </th>
                        <td>
                            {{ $staycationBooking->check_in }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.check_out') }}
                        </th>
                        <td>
                            {{ $staycationBooking->check_out }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.duration') }}
                        </th>
                        <td>
                            {{ $staycationBooking->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.quantity') }}
                        </th>
                        <td>
                            {{ $staycationBooking->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.room_charge') }}
                        </th>
                        <td>
                            {{ $staycationBooking->room_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.misc_charge') }}
                        </th>
                        <td>
                            {{ $staycationBooking->misc_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.total_charge') }}
                        </th>
                        <td>
                            {{ $staycationBooking->total_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.package') }}
                        </th>
                        <td>
                            {{ App\StaycationBooking::PACKAGE_RADIO[$staycationBooking->package] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staycationBooking.fields.booking_status') }}
                        </th>
                        <td>
                            {{ App\StaycationBooking::BOOKING_STATUS_RADIO[$staycationBooking->booking_status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.staycation-bookings.index') }}">
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
            <a class="nav-link" href="#accom_venue_packages" role="tab" data-toggle="tab">
                {{ trans('cruds.venuePackage.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="accom_venue_packages">
            @includeIf('admin.staycationBookings.relationships.accomVenuePackages', ['venuePackages' => $staycationBooking->accomVenuePackages])
        </div>
    </div>
</div>

@endsection