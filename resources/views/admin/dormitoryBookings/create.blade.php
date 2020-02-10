@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dormitoryBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dormitory-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="accom_id">{{ trans('cruds.dormitoryBooking.fields.accom') }}</label>
                <select class="form-control select2 {{ $errors->has('accom') ? 'is-invalid' : '' }}" name="accom_id" id="accom_id" required>
                    @foreach($accoms as $id => $accom)
                        <option value="{{ $id }}" {{ old('accom_id') == $id ? 'selected' : '' }}>{{ $accom }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.accom_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booked_by_id">{{ trans('cruds.dormitoryBooking.fields.booked_by') }}</label>
                <select class="form-control select2 {{ $errors->has('booked_by') ? 'is-invalid' : '' }}" name="booked_by_id" id="booked_by_id">
                    @foreach($booked_bies as $id => $booked_by)
                        <option value="{{ $id }}" {{ old('booked_by_id') == $id ? 'selected' : '' }}>{{ $booked_by }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.booked_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.dormitoryBooking.fields.duration_months') }}</label>
                @foreach(App\DormitoryBooking::DURATION_MONTHS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('duration_months') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="duration_months_{{ $key }}" name="duration_months" value="{{ $key }}" {{ old('duration_months', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="duration_months_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.duration_months_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="move_in">{{ trans('cruds.dormitoryBooking.fields.move_in') }}</label>
                <input class="form-control date {{ $errors->has('move_in') ? 'is-invalid' : '' }}" type="text" name="move_in" id="move_in" value="{{ old('move_in') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.move_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="room_charge">{{ trans('cruds.dormitoryBooking.fields.room_charge') }}</label>
                <input class="form-control {{ $errors->has('room_charge') ? 'is-invalid' : '' }}" type="number" name="room_charge" id="room_charge" value="{{ old('room_charge') }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.room_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="misc_charge">{{ trans('cruds.dormitoryBooking.fields.misc_charge') }}</label>
                <input class="form-control {{ $errors->has('misc_charge') ? 'is-invalid' : '' }}" type="number" name="misc_charge" id="misc_charge" value="{{ old('misc_charge') }}" step="0.01">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.misc_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_charge">{{ trans('cruds.dormitoryBooking.fields.total_charge') }}</label>
                <input class="form-control {{ $errors->has('total_charge') ? 'is-invalid' : '' }}" type="number" name="total_charge" id="total_charge" value="{{ old('total_charge') }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.total_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.dormitoryBooking.fields.booking_status') }}</label>
                @foreach(App\DormitoryBooking::BOOKING_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_status_{{ $key }}" name="booking_status" value="{{ $key }}" {{ old('booking_status', 'confirmed') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="booking_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.booking_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dormitoryBooking.fields.payment_type') }}</label>
                @foreach(App\DormitoryBooking::PAYMENT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('payment_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="payment_type_{{ $key }}" name="payment_type" value="{{ $key }}" {{ old('payment_type', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="payment_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dormitoryBooking.fields.payment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection