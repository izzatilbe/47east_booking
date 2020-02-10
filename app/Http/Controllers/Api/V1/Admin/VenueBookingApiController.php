<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenueBookingRequest;
use App\Http\Requests\UpdateVenueBookingRequest;
use App\Http\Resources\Admin\VenueBookingResource;
use App\VenueBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueBookingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueBookingResource(VenueBooking::with(['booked_by'])->get());
    }

    public function store(StoreVenueBookingRequest $request)
    {
        $venueBooking = VenueBooking::create($request->all());

        return (new VenueBookingResource($venueBooking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VenueBooking $venueBooking)
    {
        abort_if(Gate::denies('venue_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueBookingResource($venueBooking->load(['booked_by']));
    }

    public function update(UpdateVenueBookingRequest $request, VenueBooking $venueBooking)
    {
        $venueBooking->update($request->all());

        return (new VenueBookingResource($venueBooking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VenueBooking $venueBooking)
    {
        abort_if(Gate::denies('venue_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueBooking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}