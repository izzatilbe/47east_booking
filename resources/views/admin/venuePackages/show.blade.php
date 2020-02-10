@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.venuePackage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.venuePackage.fields.id') }}
                        </th>
                        <td>
                            {{ $venuePackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venuePackage.fields.accom') }}
                        </th>
                        <td>
                            @foreach($venuePackage->accoms as $key => $accom)
                                <span class="label label-info">{{ $accom->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venuePackage.fields.venue') }}
                        </th>
                        <td>
                            @foreach($venuePackage->venues as $key => $venue)
                                <span class="label label-info">{{ $venue->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venuePackage.fields.total_package_charge') }}
                        </th>
                        <td>
                            {{ $venuePackage->total_package_charge }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection