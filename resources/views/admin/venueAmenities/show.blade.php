@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.venueAmenity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-amenities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.venueAmenity.fields.id') }}
                        </th>
                        <td>
                            {{ $venueAmenity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venueAmenity.fields.name') }}
                        </th>
                        <td>
                            {{ $venueAmenity->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venue-amenities.index') }}">
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
            <a class="nav-link" href="#amenity_venues" role="tab" data-toggle="tab">
                {{ trans('cruds.venue.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="amenity_venues">
            @includeIf('admin.venueAmenities.relationships.amenityVenues', ['venues' => $venueAmenity->amenityVenues])
        </div>
    </div>
</div>

@endsection