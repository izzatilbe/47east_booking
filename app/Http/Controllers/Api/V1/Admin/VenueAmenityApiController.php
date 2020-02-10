<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVenueAmenityRequest;
use App\Http\Requests\UpdateVenueAmenityRequest;
use App\Http\Resources\Admin\VenueAmenityResource;
use App\VenueAmenity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueAmenityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('venue_amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueAmenityResource(VenueAmenity::all());
    }

    public function store(StoreVenueAmenityRequest $request)
    {
        $venueAmenity = VenueAmenity::create($request->all());

        if ($request->input('photo', false)) {
            $venueAmenity->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new VenueAmenityResource($venueAmenity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VenueAmenity $venueAmenity)
    {
        abort_if(Gate::denies('venue_amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueAmenityResource($venueAmenity);
    }

    public function update(UpdateVenueAmenityRequest $request, VenueAmenity $venueAmenity)
    {
        $venueAmenity->update($request->all());

        if ($request->input('photo', false)) {
            if (!$venueAmenity->photo || $request->input('photo') !== $venueAmenity->photo->file_name) {
                $venueAmenity->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($venueAmenity->photo) {
            $venueAmenity->photo->delete();
        }

        return (new VenueAmenityResource($venueAmenity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VenueAmenity $venueAmenity)
    {
        abort_if(Gate::denies('venue_amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAmenity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}