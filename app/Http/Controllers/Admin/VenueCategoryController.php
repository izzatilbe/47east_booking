<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVenueCategoryRequest;
use App\Http\Requests\StoreVenueCategoryRequest;
use App\Http\Requests\UpdateVenueCategoryRequest;
use App\VenueCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VenueCategoryController extends Controller
{
    use MediaUploadingTrait;

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

        if ($request->input('photo', false)) {
            $venueCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $venueCategory->id]);
        }

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

        if ($request->input('photo', false)) {
            if (!$venueCategory->photo || $request->input('photo') !== $venueCategory->photo->file_name) {
                $venueCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($venueCategory->photo) {
            $venueCategory->photo->delete();
        }

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('venue_category_create') && Gate::denies('venue_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VenueCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}