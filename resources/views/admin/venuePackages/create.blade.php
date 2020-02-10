@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.venuePackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.venue-packages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="accoms">{{ trans('cruds.venuePackage.fields.accom') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('accoms') ? 'is-invalid' : '' }}" name="accoms[]" id="accoms" multiple required>
                    @foreach($accoms as $id => $accom)
                        <option value="{{ $id }}" {{ in_array($id, old('accoms', [])) ? 'selected' : '' }}>{{ $accom }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venuePackage.fields.accom_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="venues">{{ trans('cruds.venuePackage.fields.venue') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('venues') ? 'is-invalid' : '' }}" name="venues[]" id="venues" multiple required>
                    @foreach($venues as $id => $venue)
                        <option value="{{ $id }}" {{ in_array($id, old('venues', [])) ? 'selected' : '' }}>{{ $venue }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venuePackage.fields.venue_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_package_charge">{{ trans('cruds.venuePackage.fields.total_package_charge') }}</label>
                <input class="form-control {{ $errors->has('total_package_charge') ? 'is-invalid' : '' }}" type="number" name="total_package_charge" id="total_package_charge" value="{{ old('total_package_charge') }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.venuePackage.fields.total_package_charge_helper') }}</span>
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