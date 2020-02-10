<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVenuePackageRequest;
use App\Http\Requests\StoreVenuePackageRequest;
use App\Http\Requests\UpdateVenuePackageRequest;
use App\Venue;
use App\VenuePackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenuePackageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venuePackages = VenuePackage::all();

        return view('admin.venuePackages.index', compact('venuePackages'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accoms = Accommodation::all()->pluck('name', 'id');

        $venues = Venue::all()->pluck('name', 'id');

        return view('admin.venuePackages.create', compact('accoms', 'venues'));
    }

    public function store(StoreVenuePackageRequest $request)
    {
        $venuePackage = VenuePackage::create($request->all());
        $venuePackage->accoms()->sync($request->input('accoms', []));
        $venuePackage->venues()->sync($request->input('venues', []));

        return redirect()->route('admin.venue-packages.index');
    }

    public function edit(VenuePackage $venuePackage)
    {
        abort_if(Gate::denies('venue_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accoms = Accommodation::all()->pluck('name', 'id');

        $venues = Venue::all()->pluck('name', 'id');

        $venuePackage->load('accoms', 'venues');

        return view('admin.venuePackages.edit', compact('accoms', 'venues', 'venuePackage'));
    }

    public function update(UpdateVenuePackageRequest $request, VenuePackage $venuePackage)
    {
        $venuePackage->update($request->all());
        $venuePackage->accoms()->sync($request->input('accoms', []));
        $venuePackage->venues()->sync($request->input('venues', []));

        return redirect()->route('admin.venue-packages.index');
    }

    public function show(VenuePackage $venuePackage)
    {
        abort_if(Gate::denies('venue_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venuePackage->load('accoms', 'venues');

        return view('admin.venuePackages.show', compact('venuePackage'));
    }

    public function destroy(VenuePackage $venuePackage)
    {
        abort_if(Gate::denies('venue_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venuePackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenuePackageRequest $request)
    {
        VenuePackage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}