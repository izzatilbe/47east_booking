<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DormitoryBooking;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDormitoryBookingRequest;
use App\Http\Requests\UpdateDormitoryBookingRequest;
use App\Http\Resources\Admin\DormitoryBookingResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DormitoryBookingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dormitory_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DormitoryBookingResource(DormitoryBooking::with(['accom', 'booked_by'])->get());
    }

    public function store(StoreDormitoryBookingRequest $request)
    {
        $dormitoryBooking = DormitoryBooking::create($request->all());

        return (new DormitoryBookingResource($dormitoryBooking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DormitoryBooking $dormitoryBooking)
    {
        abort_if(Gate::denies('dormitory_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DormitoryBookingResource($dormitoryBooking->load(['accom', 'booked_by']));
    }

    public function update(UpdateDormitoryBookingRequest $request, DormitoryBooking $dormitoryBooking)
    {
        $dormitoryBooking->update($request->all());

        return (new DormitoryBookingResource($dormitoryBooking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DormitoryBooking $dormitoryBooking)
    {
        abort_if(Gate::denies('dormitory_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dormitoryBooking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}