<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVenueRequest;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Venue;
use App\VenueAmenity;
use App\VenueCategory;
use App\VenueTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VenueController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('venue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venues = Venue::all();

        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = VenueCategory::all()->pluck('name', 'id');

        $tags = VenueTag::all()->pluck('name', 'id');

        $amenities = VenueAmenity::all()->pluck('name', 'id');

        return view('admin.venues.create', compact('categories', 'tags', 'amenities'));
    }

    public function store(StoreVenueRequest $request)
    {
        $venue = Venue::create($request->all());
        $venue->categories()->sync($request->input('categories', []));
        $venue->tags()->sync($request->input('tags', []));
        $venue->amenities()->sync($request->input('amenities', []));

        foreach ($request->input('photo', []) as $file) {
            $venue->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $venue->id]);
        }

        return redirect()->route('admin.venues.index');
    }

    public function edit(Venue $venue)
    {
        abort_if(Gate::denies('venue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = VenueCategory::all()->pluck('name', 'id');

        $tags = VenueTag::all()->pluck('name', 'id');

        $amenities = VenueAmenity::all()->pluck('name', 'id');

        $venue->load('categories', 'tags', 'amenities');

        return view('admin.venues.edit', compact('categories', 'tags', 'amenities', 'venue'));
    }

    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue->update($request->all());
        $venue->categories()->sync($request->input('categories', []));
        $venue->tags()->sync($request->input('tags', []));
        $venue->amenities()->sync($request->input('amenities', []));

        if (count($venue->photo) > 0) {
            foreach ($venue->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $venue->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $venue->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.venues.index');
    }

    public function show(Venue $venue)
    {
        abort_if(Gate::denies('venue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venue->load('categories', 'tags', 'amenities', 'venueVenuePackages');

        return view('admin.venues.show', compact('venue'));
    }

    public function destroy(Venue $venue)
    {
        abort_if(Gate::denies('venue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venue->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueRequest $request)
    {
        Venue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('venue_create') && Gate::denies('venue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Venue();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}