<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenuePackageRequest;
use App\Http\Requests\UpdateVenuePackageRequest;
use App\Http\Resources\Admin\VenuePackageResource;
use App\VenuePackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenuePackageApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenuePackageResource(VenuePackage::with(['accoms', 'venues'])->get());
    }

    public function store(StoreVenuePackageRequest $request)
    {
        $venuePackage = VenuePackage::create($request->all());
        $venuePackage->accoms()->sync($request->input('accoms', []));
        $venuePackage->venues()->sync($request->input('venues', []));

        return (new VenuePackageResource($venuePackage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VenuePackage $venuePackage)
    {
        abort_if(Gate::denies('venue_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenuePackageResource($venuePackage->load(['accoms', 'venues']));
    }

    public function update(UpdateVenuePackageRequest $request, VenuePackage $venuePackage)
    {
        $venuePackage->update($request->all());
        $venuePackage->accoms()->sync($request->input('accoms', []));
        $venuePackage->venues()->sync($request->input('venues', []));

        return (new VenuePackageResource($venuePackage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VenuePackage $venuePackage)
    {
        abort_if(Gate::denies('venue_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venuePackage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}