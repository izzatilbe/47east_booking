<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenueTagRequest;
use App\Http\Requests\UpdateVenueTagRequest;
use App\Http\Resources\Admin\VenueTagResource;
use App\VenueTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueTagApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueTagResource(VenueTag::all());
    }

    public function store(StoreVenueTagRequest $request)
    {
        $venueTag = VenueTag::create($request->all());

        return (new VenueTagResource($venueTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VenueTag $venueTag)
    {
        abort_if(Gate::denies('venue_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueTagResource($venueTag);
    }

    public function update(UpdateVenueTagRequest $request, VenueTag $venueTag)
    {
        $venueTag->update($request->all());

        return (new VenueTagResource($venueTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VenueTag $venueTag)
    {
        abort_if(Gate::denies('venue_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}