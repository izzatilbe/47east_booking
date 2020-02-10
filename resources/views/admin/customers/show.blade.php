@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.id') }}
                        </th>
                        <td>
                            {{ $customer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $customer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.last_name') }}
                        </th>
                        <td>
                            {{ $customer->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.email') }}
                        </th>
                        <td>
                            {{ $customer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.phone') }}
                        </th>
                        <td>
                            {{ $customer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.address') }}
                        </th>
                        <td>
                            {{ $customer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.skype') }}
                        </th>
                        <td>
                            {{ $customer->skype }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.website') }}
                        </th>
                        <td>
                            {{ $customer->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.description') }}
                        </th>
                        <td>
                            {{ $customer->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
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
            <a class="nav-link" href="#booked_by_dormitory_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.dormitoryBooking.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#booked_by_venue_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.venueBooking.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#booked_by_staycation_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.staycationBooking.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#booked_by_coworkings" role="tab" data-toggle="tab">
                {{ trans('cruds.coworking.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="booked_by_dormitory_bookings">
            @includeIf('admin.customers.relationships.bookedByDormitoryBookings', ['dormitoryBookings' => $customer->bookedByDormitoryBookings])
        </div>
        <div class="tab-pane" role="tabpanel" id="booked_by_venue_bookings">
            @includeIf('admin.customers.relationships.bookedByVenueBookings', ['venueBookings' => $customer->bookedByVenueBookings])
        </div>
        <div class="tab-pane" role="tabpanel" id="booked_by_staycation_bookings">
            @includeIf('admin.customers.relationships.bookedByStaycationBookings', ['staycationBookings' => $customer->bookedByStaycationBookings])
        </div>
        <div class="tab-pane" role="tabpanel" id="booked_by_coworkings">
            @includeIf('admin.customers.relationships.bookedByCoworkings', ['coworkings' => $customer->bookedByCoworkings])
        </div>
    </div>
</div>

@endsection