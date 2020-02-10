<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVenueTagRequest;
use App\Http\Requests\StoreVenueTagRequest;
use App\Http\Requests\UpdateVenueTagRequest;
use App\VenueTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueTags = VenueTag::all();

        return view('admin.venueTags.index', compact('venueTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueTags.create');
    }

    public function store(StoreVenueTagRequest $request)
    {
        $venueTag = VenueTag::create($request->all());

        return redirect()->route('admin.venue-tags.index');
    }

    public function edit(VenueTag $venueTag)
    {
        abort_if(Gate::denies('venue_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueTags.edit', compact('venueTag'));
    }

    public function update(UpdateVenueTagRequest $request, VenueTag $venueTag)
    {
        $venueTag->update($request->all());

        return redirect()->route('admin.venue-tags.index');
    }

    public function show(VenueTag $venueTag)
    {
        abort_if(Gate::denies('venue_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueTag->load('tagVenues');

        return view('admin.venueTags.show', compact('venueTag'));
    }

    public function destroy(VenueTag $venueTag)
    {
        abort_if(Gate::denies('venue_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueTagRequest $request)
    {
        VenueTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}