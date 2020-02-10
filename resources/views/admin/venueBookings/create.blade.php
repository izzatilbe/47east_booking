@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.venueBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.venue-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="booked_by_id">{{ trans('cruds.venueBooking.fields.booked_by') }}</label>
                <select class="form-control select2 {{ $errors->has('booked_by') ? 'is-invalid' : '' }}" name="booked_by_id" id="booked_by_id">
                    @foreach($booked_bies as $id => $booked_by)
                        <option value="{{ $id }}" {{ old('booked_by_id') == $id ? 'selected' : '' }}>{{ $booked_by }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.booked_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="datetime_start">{{ trans('cruds.venueBooking.fields.datetime_start') }}</label>
                <input class="form-control datetime {{ $errors->has('datetime_start') ? 'is-invalid' : '' }}" type="text" name="datetime_start" id="datetime_start" value="{{ old('datetime_start') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.datetime_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="datetime_end">{{ trans('cruds.venueBooking.fields.datetime_end') }}</label>
                <input class="form-control datetime {{ $errors->has('datetime_end') ? 'is-invalid' : '' }}" type="text" name="datetime_end" id="datetime_end" value="{{ old('datetime_end') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.datetime_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="duration">{{ trans('cruds.venueBooking.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="text" name="duration" id="duration" value="{{ old('duration', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="room_charge">{{ trans('cruds.venueBooking.fields.room_charge') }}</label>
                <input class="form-control {{ $errors->has('room_charge') ? 'is-invalid' : '' }}" type="number" name="room_charge" id="room_charge" value="{{ old('room_charge') }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.room_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="misc_charge">{{ trans('cruds.venueBooking.fields.misc_charge') }}</label>
                <input class="form-control {{ $errors->has('misc_charge') ? 'is-invalid' : '' }}" type="number" name="misc_charge" id="misc_charge" value="{{ old('misc_charge') }}" step="0.01">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.misc_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_charge">{{ trans('cruds.venueBooking.fields.total_charge') }}</label>
                <input class="form-control {{ $errors->has('total_charge') ? 'is-invalid' : '' }}" type="number" name="total_charge" id="total_charge" value="{{ old('total_charge') }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.total_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.venueBooking.fields.payment_type') }}</label>
                @foreach(App\VenueBooking::PAYMENT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('payment_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="payment_type_{{ $key }}" name="payment_type" value="{{ $key }}" {{ old('payment_type', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="payment_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.payment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.venueBooking.fields.booking_status') }}</label>
                @foreach(App\VenueBooking::BOOKING_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_status_{{ $key }}" name="booking_status" value="{{ $key }}" {{ old('booking_status', 'confirmed') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="booking_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venueBooking.fields.booking_status_helper') }}</span>
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