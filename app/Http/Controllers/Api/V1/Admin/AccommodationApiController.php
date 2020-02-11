<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Accommodation;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Http\Resources\Admin\AccommodationResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccommodationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('accommodation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccommodationResource(Accommodation::with(['categories', 'tags', 'amenities'])->get());
    }

    public function store(StoreAccommodationRequest $request)
    {
        $accommodation = Accommodation::create($request->all());
        $accommodation->categories()->sync($request->input('categories', []));
        $accommodation->tags()->sync($request->input('tags', []));
        $accommodation->amenities()->sync($request->input('amenities', []));

        if ($request->input('photo', false)) {
            $accommodation->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new AccommodationResource($accommodation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Accommodation $accommodation)
    {
        abort_if(Gate::denies('accommodation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccommodationResource($accommodation->load(['categories', 'tags', 'amenities']));
    }

    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        $accommodation->update($request->all());
        $accommodation->categories()->sync($request->input('categories', []));
        $accommodation->tags()->sync($request->input('tags', []));
        $accommodation->amenities()->sync($request->input('amenities', []));

        if ($request->input('photo', false)) {
            if (!$accommodation->photo || $request->input('photo') !== $accommodation->photo->file_name) {
                $accommodation->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($accommodation->photo) {
            $accommodation->photo->delete();
        }

        return (new AccommodationResource($accommodation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Accommodation $accommodation)
    {
        abort_if(Gate::denies('accommodation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accommodation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
}