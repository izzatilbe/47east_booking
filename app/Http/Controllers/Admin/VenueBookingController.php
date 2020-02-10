<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVenueBookingRequest;
use App\Http\Requests\StoreVenueBookingRequest;
use App\Http\Requests\UpdateVenueBookingRequest;
use App\VenueBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueBookingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueBookings = VenueBooking::all();

        return view('admin.venueBookings.index', compact('venueBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.venueBookings.create', compact('booked_bies'));
    }

    public function store(StoreVenueBookingRequest $request)
    {
        $venueBooking = VenueBooking::create($request->all());

        return redirect()->route('admin.venue-bookings.index');
    }

    public function edit(VenueBooking $venueBooking)
    {
        abort_if(Gate::denies('venue_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venueBooking->load('booked_by');

        return view('admin.venueBookings.edit', compact('booked_bies', 'venueBooking'));
    }

    public function update(UpdateVenueBookingRequest $request, VenueBooking $venueBooking)
    {
        $venueBooking->update($request->all());

        return redirect()->route('admin.venue-bookings.index');
    }

    public function show(VenueBooking $venueBooking)
    {
        abort_if(Gate::denies('venue_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueBooking->load('booked_by', 'venueVenuePackages');

        return view('admin.venueBookings.show', compact('venueBooking'));
    }

    public function destroy(VenueBooking $venueBooking)
    {
        abort_if(Gate::denies('venue_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueBookingRequest $request)
    {
        VenueBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}