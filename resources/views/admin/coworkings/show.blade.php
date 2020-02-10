@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coworking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coworkings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.id') }}
                        </th>
                        <td>
                            {{ $coworking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.booked_by') }}
                        </th>
                        <td>
                            {{ $coworking->booked_by->last_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.date_start') }}
                        </th>
                        <td>
                            {{ $coworking->date_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.date_end') }}
                        </th>
                        <td>
                            {{ $coworking->date_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.duration') }}
                        </th>
                        <td>
                            {{ $coworking->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.quantity') }}
                        </th>
                        <td>
                            {{ $coworking->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.total_charge') }}
                        </th>
                        <td>
                            {{ $coworking->total_charge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.booking_status') }}
                        </th>
                        <td>
                            {{ App\Coworking::BOOKING_STATUS_RADIO[$coworking->booking_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coworking.fields.pass_type') }}
                        </th>
                        <td>
                            {{ App\Coworking::PASS_TYPE_RADIO[$coworking->pass_type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coworkings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection