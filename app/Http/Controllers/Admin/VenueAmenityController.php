<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVenueAmenityRequest;
use App\Http\Requests\StoreVenueAmenityRequest;
use App\Http\Requests\UpdateVenueAmenityRequest;
use App\VenueAmenity;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VenueAmenityController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('venue_amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAmenities = VenueAmenity::all();

        return view('admin.venueAmenities.index', compact('venueAmenities'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueAmenities.create');
    }

    public function store(StoreVenueAmenityRequest $request)
    {
        $venueAmenity = VenueAmenity::create($request->all());

        if ($request->input('photo', false)) {
            $venueAmenity->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $venueAmenity->id]);
        }

        return redirect()->route('admin.venue-amenities.index');
    }

    public function edit(VenueAmenity $venueAmenity)
    {
        abort_if(Gate::denies('venue_amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.venueAmenities.edit', compact('venueAmenity'));
    }

    public function update(UpdateVenueAmenityRequest $request, VenueAmenity $venueAmenity)
    {
        $venueAmenity->update($request->all());

        if ($request->input('photo', false)) {
            if (!$venueAmenity->photo || $request->input('photo') !== $venueAmenity->photo->file_name) {
                $venueAmenity->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($venueAmenity->photo) {
            $venueAmenity->photo->delete();
        }

        return redirect()->route('admin.venue-amenities.index');
    }

    public function show(VenueAmenity $venueAmenity)
    {
        abort_if(Gate::denies('venue_amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAmenity->load('amenityVenues');

        return view('admin.venueAmenities.show', compact('venueAmenity'));
    }

    public function destroy(VenueAmenity $venueAmenity)
    {
        abort_if(Gate::denies('venue_amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAmenity->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueAmenityRequest $request)
    {
        VenueAmenity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('venue_amenity_create') && Gate::denies('venue_amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VenueAmenity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}