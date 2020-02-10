@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accomAmenity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accom-amenities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accomAmenity.fields.id') }}
                        </th>
                        <td>
                            {{ $accomAmenity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accomAmenity.fields.name') }}
                        </th>
                        <td>
                            {{ $accomAmenity->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accomAmenity.fields.description') }}
                        </th>
                        <td>
                            {{ $accomAmenity->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accomAmenity.fields.photo') }}
                        </th>
                        <td>
                            @if($accomAmenity->photo)
                                <a href="{{ $accomAmenity->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $accomAmenity->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accom-amenities.index') }}">
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
            <a class="nav-link" href="#amenity_accommodations" role="tab" data-toggle="tab">
                {{ trans('cruds.accommodation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="amenity_accommodations">
            @includeIf('admin.accomAmenities.relationships.amenityAccommodations', ['accommodations' => $accomAmenity->amenityAccommodations])
        </div>
    </div>
</div>

@endsection