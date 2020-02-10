@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dormitoryBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dormitory-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.accom') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->accom->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.booked_by') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->booked_by->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.duration_months') }}
                        </th>
                        <td>
                            {{ App\DormitoryBooking::DURATION_MONTHS_RADIO[$dormitoryBooking->duration_months] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.move_in') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->move_in }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.room_charge') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->room_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.misc_charge') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->misc_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.total_charge') }}
                        </th>
                        <td>
                            {{ $dormitoryBooking->total_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.booking_status') }}
                        </th>
                        <td>
                            {{ App\DormitoryBooking::BOOKING_STATUS_RADIO[$dormitoryBooking->booking_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dormitoryBooking.fields.payment_type') }}
                        </th>
                        <td>
                            {{ App\DormitoryBooking::PAYMENT_TYPE_RADIO[$dormitoryBooking->payment_type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dormitory-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection