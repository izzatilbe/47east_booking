<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Customer;
use App\DormitoryBooking;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDormitoryBookingRequest;
use App\Http\Requests\StoreDormitoryBookingRequest;
use App\Http\Requests\UpdateDormitoryBookingRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DormitoryBookingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dormitory_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dormitoryBookings = DormitoryBooking::all();

        return view('admin.dormitoryBookings.index', compact('dormitoryBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('dormitory_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accoms = Accommodation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dormitoryBookings.create', compact('accoms', 'booked_bies'));
    }

    public function store(StoreDormitoryBookingRequest $request)
    {
        $dormitoryBooking = DormitoryBooking::create($request->all());

        return redirect()->route('admin.dormitory-bookings.index');
    }

    public function edit(DormitoryBooking $dormitoryBooking)
    {
        abort_if(Gate::denies('dormitory_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accoms = Accommodation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dormitoryBooking->load('accom', 'booked_by');

        return view('admin.dormitoryBookings.edit', compact('accoms', 'booked_bies', 'dormitoryBooking'));
    }

    public function update(UpdateDormitoryBookingRequest $request, DormitoryBooking $dormitoryBooking)
    {
        $dormitoryBooking->update($request->all());

        return redirect()->route('admin.dormitory-bookings.index');
    }

    public function show(DormitoryBooking $dormitoryBooking)
    {
        abort_if(Gate::denies('dormitory_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dormitoryBooking->load('accom', 'booked_by');

        return view('admin.dormitoryBookings.show', compact('dormitoryBooking'));
    }

    public function destroy(DormitoryBooking $dormitoryBooking)
    {
        abort_if(Gate::denies('dormitory_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dormitoryBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyDormitoryBookingRequest $request)
    {
        DormitoryBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}