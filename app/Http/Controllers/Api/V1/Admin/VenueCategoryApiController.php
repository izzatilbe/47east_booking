<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVenueCategoryRequest;
use App\Http\Requests\StoreVenueCategoryRequest;
use App\Http\Requests\UpdateVenueCategoryRequest;
use App\VenueCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueCategories = VenueCategory::all();

        return view('admin.venueCategories.index', compact('venueCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueCategories.create');
    }

    public function store(StoreVenueCategoryRequest $request)
    {
        $venueCategory = VenueCategory::create($request->all());

        return redirect()->route('admin.venue-categories.index');
    }

    public function edit(VenueCategory $venueCategory)
    {
        abort_if(Gate::denies('venue_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueCategories.edit', compact('venueCategory'));
    }

    public function update(UpdateVenueCategoryRequest $request, VenueCategory $venueCategory)
    {
        $venueCategory->update($request->all());

        return redirect()->route('admin.venue-categories.index');
    }

    public function show(VenueCategory $venueCategory)
    {
        abort_if(Gate::denies('venue_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueCategory->load('categoryVenues');

        return view('admin.venueCategories.show', compact('venueCategory'));
    }

    public function destroy(VenueCategory $venueCategory)
    {
        abort_if(Gate::denies('venue_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueCategoryRequest $request)
    {
        VenueCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}