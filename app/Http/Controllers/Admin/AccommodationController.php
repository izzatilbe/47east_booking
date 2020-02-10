<?php

namespace App\Http\Controllers\Admin;

use App\AccomAmenity;
use App\AccomCategory;
use App\Accommodation;
use App\AccomTag;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccommodationRequest;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AccommodationController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('accommodation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accommodations = Accommodation::all();

        return view('admin.accommodations.index', compact('accommodations'));
    }

    public function create()
    {
        abort_if(Gate::denies('accommodation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AccomCategory::all()->pluck('name', 'id');

        $tags = AccomTag::all()->pluck('name', 'id');

        $amenities = AccomAmenity::all()->pluck('name', 'id');

        return view('admin.accommodations.create', compact('categories', 'tags', 'amenities'));
    }

    public function store(StoreAccommodationRequest $request)
    {
        $accommodation = Accommodation::create($request->all());
        $accommodation->categories()->sync($request->input('categories', []));
        $accommodation->tags()->sync($request->input('tags', []));
        $accommodation->amenities()->sync($request->input('amenities', []));

        foreach ($request->input('photo', []) as $file) {
            $accommodation->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $accommodation->id]);
        }

        return redirect()->route('admin.accommodations.index');
    }

    public function edit(Accommodation $accommodation)
    {
        abort_if(Gate::denies('accommodation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AccomCategory::all()->pluck('name', 'id');

        $tags = AccomTag::all()->pluck('name', 'id');

        $amenities = AccomAmenity::all()->pluck('name', 'id');

        $accommodation->load('categories', 'tags', 'amenities');

        return view('admin.accommodations.edit', compact('categories', 'tags', 'amenities', 'accommodation'));
    }

    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        $accommodation->update($request->all());
        $accommodation->categories()->sync($request->input('categories', []));
        $accommodation->tags()->sync($request->input('tags', []));
        $accommodation->amenities()->sync($request->input('amenities', []));

        if (count($accommodation->photo) > 0) {
            foreach ($accommodation->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $accommodation->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $accommodation->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.accommodations.index');
    }

    public function show(Accommodation $accommodation)
    {
        abort_if(Gate::denies('accommodation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accommodation->load('categories', 'tags', 'amenities', 'accomDormitoryBookings', 'accomStaycationBookings', 'accomCoworkings', 'accomVenuePackages');

        return view('admin.accommodations.show', compact('accommodation'));
    }

    public function destroy(Accommodation $accommodation)
    {
        abort_if(Gate::denies('accommodation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accommodation->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccommodationRequest $request)
    {
        Accommodation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accommodation_create') && Gate::denies('accommodation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Accommodation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}