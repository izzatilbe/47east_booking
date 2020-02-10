<?php

namespace App\Http\Controllers\Admin;

use App\AccomAmenity;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccomAmenityRequest;
use App\Http\Requests\StoreAccomAmenityRequest;
use App\Http\Requests\UpdateAccomAmenityRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccomAmenityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accom_amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomAmenities = AccomAmenity::all();

        return view('admin.accomAmenities.index', compact('accomAmenities'));
    }

    public function create()
    {
        abort_if(Gate::denies('accom_amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accomAmenities.create');
    }

    public function store(StoreAccomAmenityRequest $request)
    {
        $accomAmenity = AccomAmenity::create($request->all());

        return redirect()->route('admin.accom-amenities.index');
    }

    public function edit(AccomAmenity $accomAmenity)
    {
        abort_if(Gate::denies('accom_amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accomAmenities.edit', compact('accomAmenity'));
    }

    public function update(UpdateAccomAmenityRequest $request, AccomAmenity $accomAmenity)
    {
        $accomAmenity->update($request->all());

        return redirect()->route('admin.accom-amenities.index');
    }

    public function show(AccomAmenity $accomAmenity)
    {
        abort_if(Gate::denies('accom_amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomAmenity->load('amenityAccommodations');

        return view('admin.accomAmenities.show', compact('accomAmenity'));
    }

    public function destroy(AccomAmenity $accomAmenity)
    {
        abort_if(Gate::denies('accom_amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomAmenity->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccomAmenityRequest $request)
    {
        AccomAmenity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}