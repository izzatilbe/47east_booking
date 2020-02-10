@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.staycationBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.staycation-bookings.update", [$staycationBooking->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="booked_by_id">{{ trans('cruds.staycationBooking.fields.booked_by') }}</label>
                <select class="form-control select2 {{ $errors->has('booked_by') ? 'is-invalid' : '' }}" name="booked_by_id" id="booked_by_id">
                    @foreach($booked_bies as $id => $booked_by)
                        <option value="{{ $id }}" {{ ($staycationBooking->booked_by ? $staycationBooking->booked_by->id : old('booked_by_id')) == $id ? 'selected' : '' }}>{{ $booked_by }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.booked_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="accom_id">{{ trans('cruds.staycationBooking.fields.accom') }}</label>
                <select class="form-control select2 {{ $errors->has('accom') ? 'is-invalid' : '' }}" name="accom_id" id="accom_id" required>
                    @foreach($accoms as $id => $accom)
                        <option value="{{ $id }}" {{ ($staycationBooking->accom ? $staycationBooking->accom->id : old('accom_id')) == $id ? 'selected' : '' }}>{{ $accom }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.accom_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="check_in">{{ trans('cruds.staycationBooking.fields.check_in') }}</label>
                <input class="form-control date {{ $errors->has('check_in') ? 'is-invalid' : '' }}" type="text" name="check_in" id="check_in" value="{{ old('check_in', $staycationBooking->check_in) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.check_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="check_out">{{ trans('cruds.staycationBooking.fields.check_out') }}</label>
                <input class="form-control date {{ $errors->has('check_out') ? 'is-invalid' : '' }}" type="text" name="check_out" id="check_out" value="{{ old('check_out', $staycationBooking->check_out) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.check_out_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration">{{ trans('cruds.staycationBooking.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', $staycationBooking->duration) }}" step="1">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.staycationBooking.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $staycationBooking->quantity) }}" step="1">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="room_charge">{{ trans('cruds.staycationBooking.fields.room_charge') }}</label>
                <input class="form-control {{ $errors->has('room_charge') ? 'is-invalid' : '' }}" type="number" name="room_charge" id="room_charge" value="{{ old('room_charge', $staycationBooking->room_charge) }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.room_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="misc_charge">{{ trans('cruds.staycationBooking.fields.misc_charge') }}</label>
                <input class="form-control {{ $errors->has('misc_charge') ? 'is-invalid' : '' }}" type="number" name="misc_charge" id="misc_charge" value="{{ old('misc_charge', $staycationBooking->misc_charge) }}" step="0.01">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.misc_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_charge">{{ trans('cruds.staycationBooking.fields.total_charge') }}</label>
                <input class="form-control {{ $errors->has('total_charge') ? 'is-invalid' : '' }}" type="number" name="total_charge" id="total_charge" value="{{ old('total_charge', $staycationBooking->total_charge) }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.total_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.staycationBooking.fields.package') }}</label>
                @foreach(App\StaycationBooking::PACKAGE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('package') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="package_{{ $key }}" name="package" value="{{ $key }}" {{ old('package', $staycationBooking->package) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="package_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.package_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.staycationBooking.fields.booking_status') }}</label>
                @foreach(App\StaycationBooking::BOOKING_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_status_{{ $key }}" name="booking_status" value="{{ $key }}" {{ old('booking_status', $staycationBooking->booking_status) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="booking_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.booking_status_helper') }}</span>
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