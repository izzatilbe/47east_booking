<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStaycationBookingRequest;
use App\Http\Requests\StoreStaycationBookingRequest;
use App\Http\Requests\UpdateStaycationBookingRequest;
use App\StaycationBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaycationBookingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staycation_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staycationBookings = StaycationBooking::all();

        return view('admin.staycationBookings.index', compact('staycationBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('staycation_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accoms = Accommodation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.staycationBookings.create', compact('booked_bies', 'accoms'));
    }

    public function store(StoreStaycationBookingRequest $request)
    {
        $staycationBooking = StaycationBooking::create($request->all());

        return redirect()->route('admin.staycation-bookings.index');
    }

    public function edit(StaycationBooking $staycationBooking)
    {
        abort_if(Gate::denies('staycation_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accoms = Accommodation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staycationBooking->load('booked_by', 'accom');

        return view('admin.staycationBookings.edit', compact('booked_bies', 'accoms', 'staycationBooking'));
    }

    public function update(UpdateStaycationBookingRequest $request, StaycationBooking $staycationBooking)
    {
        $staycationBooking->update($request->all());

        return redirect()->route('admin.staycation-bookings.index');
    }

    public function show(StaycationBooking $staycationBooking)
    {
        abort_if(Gate::denies('staycation_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staycationBooking->load('booked_by', 'accom', 'accomVenuePackages');

        return view('admin.staycationBookings.show', compact('staycationBooking'));
    }

    public function destroy(StaycationBooking $staycationBooking)
    {
        abort_if(Gate::denies('staycation_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staycationBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaycationBookingRequest $request)
    {
        StaycationBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}