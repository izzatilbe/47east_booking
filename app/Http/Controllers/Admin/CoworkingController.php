<?php

namespace App\Http\Controllers\Admin;

use App\Coworking;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCoworkingRequest;
use App\Http\Requests\StoreCoworkingRequest;
use App\Http\Requests\UpdateCoworkingRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoworkingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coworking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coworkings = Coworking::all();

        return view('admin.coworkings.index', compact('coworkings'));
    }

    public function create()
    {
        abort_if(Gate::denies('coworking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.coworkings.create', compact('booked_bies'));
    }

    public function store(StoreCoworkingRequest $request)
    {
        $coworking = Coworking::create($request->all());

        return redirect()->route('admin.coworkings.index');
    }

    public function edit(Coworking $coworking)
    {
        abort_if(Gate::denies('coworking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booked_bies = Customer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coworking->load('booked_by');

        return view('admin.coworkings.edit', compact('booked_bies', 'coworking'));
    }

    public function update(UpdateCoworkingRequest $request, Coworking $coworking)
    {
        $coworking->update($request->all());

        return redirect()->route('admin.coworkings.index');
    }

    public function show(Coworking $coworking)
    {
        abort_if(Gate::denies('coworking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coworking->load('booked_by');

        return view('admin.coworkings.show', compact('coworking'));
    }

    public function destroy(Coworking $coworking)
    {
        abort_if(Gate::denies('coworking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coworking->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoworkingRequest $request)
    {
        Coworking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}