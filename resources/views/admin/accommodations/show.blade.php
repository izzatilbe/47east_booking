@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accommodation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accommodations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.id') }}
                        </th>
                        <td>
                            {{ $accommodation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.name') }}
                        </th>
                        <td>
                            {{ $accommodation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.short_description') }}
                        </th>
                        <td>
                            {{ $accommodation->short_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.category') }}
                        </th>
                        <td>
                            @foreach($accommodation->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.tag') }}
                        </th>
                        <td>
                            @foreach($accommodation->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.description') }}
                        </th>
                        <td>
                            {{ $accommodation->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.capacity') }}
                        </th>
                        <td>
                            {{ $accommodation->capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.amenity') }}
                        </th>
                        <td>
                            @foreach($accommodation->amenities as $key => $amenity)
                                <span class="label label-info">{{ $amenity->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.price') }}
                        </th>
                        <td>
                            {{ $accommodation->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accommodation.fields.photo') }}
                        </th>
                        <td>
                            @foreach($accommodation->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accommodations.index') }}">
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
            <a class="nav-link" href="#accom_dormitory_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.dormitoryBooking.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#accom_staycation_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.staycationBooking.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#accom_venue_packages" role="tab" data-toggle="tab">
                {{ trans('cruds.venuePackage.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="accom_dormitory_bookings">
            @includeIf('admin.accommodations.relationships.accomDormitoryBookings', ['dormitoryBookings' => $accommodation->accomDormitoryBookings])
        </div>
        <div class="tab-pane" role="tabpanel" id="accom_staycation_bookings">
            @includeIf('admin.accommodations.relationships.accomStaycationBookings', ['staycationBookings' => $accommodation->accomStaycationBookings])
        </div>
        <div class="tab-pane" role="tabpanel" id="accom_venue_packages">
            @includeIf('admin.accommodations.relationships.accomVenuePackages', ['venuePackages' => $accommodation->accomVenuePackages])
        </div>
    </div>
</div>

@endsection