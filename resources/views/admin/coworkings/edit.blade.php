@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.coworking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.coworkings.update", [$coworking->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="booked_by_id">{{ trans('cruds.coworking.fields.booked_by') }}</label>
                <select class="form-control select2 {{ $errors->has('booked_by') ? 'is-invalid' : '' }}" name="booked_by_id" id="booked_by_id" required>
                    @foreach($booked_bies as $id => $booked_by)
                        <option value="{{ $id }}" {{ ($coworking->booked_by ? $coworking->booked_by->id : old('booked_by_id')) == $id ? 'selected' : '' }}>{{ $booked_by }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.booked_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_start">{{ trans('cruds.coworking.fields.date_start') }}</label>
                <input class="form-control date {{ $errors->has('date_start') ? 'is-invalid' : '' }}" type="text" name="date_start" id="date_start" value="{{ old('date_start', $coworking->date_start) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.date_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_end">{{ trans('cruds.coworking.fields.date_end') }}</label>
                <input class="form-control date {{ $errors->has('date_end') ? 'is-invalid' : '' }}" type="text" name="date_end" id="date_end" value="{{ old('date_end', $coworking->date_end) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.date_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration">{{ trans('cruds.coworking.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', $coworking->duration) }}" step="1">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.coworking.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $coworking->quantity) }}" step="1" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_charge">{{ trans('cruds.coworking.fields.total_charge') }}</label>
                <input class="form-control {{ $errors->has('total_charge') ? 'is-invalid' : '' }}" type="number" name="total_charge" id="total_charge" value="{{ old('total_charge', $coworking->total_charge) }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.total_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.coworking.fields.booking_status') }}</label>
                @foreach(App\Coworking::BOOKING_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_status_{{ $key }}" name="booking_status" value="{{ $key }}" {{ old('booking_status', $coworking->booking_status) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="booking_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.booking_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.coworking.fields.pass_type') }}</label>
                @foreach(App\Coworking::PASS_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('pass_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="pass_type_{{ $key }}" name="pass_type" value="{{ $key }}" {{ old('pass_type', $coworking->pass_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="pass_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.coworking.fields.pass_type_helper') }}</span>
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