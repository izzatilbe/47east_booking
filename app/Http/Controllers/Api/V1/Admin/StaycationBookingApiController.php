<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaycationBookingRequest;
use App\Http\Requests\UpdateStaycationBookingRequest;
use App\Http\Resources\Admin\StaycationBookingResource;
use App\StaycationBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaycationBookingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staycation_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaycationBookingResource(StaycationBooking::with(['booked_by', 'accom'])->get());
    }

    public function store(StoreStaycationBookingRequest $request)
    {
        $staycationBooking = StaycationBooking::create($request->all());

        return (new StaycationBookingResource($staycationBooking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StaycationBooking $staycationBooking)
    {
        abort_if(Gate::denies('staycation_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaycationBookingResource($staycationBooking->load(['booked_by', 'accom']));
    }

    public function update(UpdateStaycationBookingRequest $request, StaycationBooking $staycationBooking)
    {
        $staycationBooking->update($request->all());

        return (new StaycationBookingResource($staycationBooking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StaycationBooking $staycationBooking)
    {
        abort_if(Gate::denies('staycation_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staycationBooking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}