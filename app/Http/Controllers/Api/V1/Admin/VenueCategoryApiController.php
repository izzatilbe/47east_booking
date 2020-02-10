<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVenueCategoryRequest;
use App\Http\Requests\UpdateVenueCategoryRequest;
use App\Http\Resources\Admin\VenueCategoryResource;
use App\VenueCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('venue_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueCategoryResource(VenueCategory::all());
    }

    public function store(StoreVenueCategoryRequest $request)
    {
        $venueCategory = VenueCategory::create($request->all());

        if ($request->input('photo', false)) {
            $venueCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new VenueCategoryResource($venueCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VenueCategory $venueCategory)
    {
        abort_if(Gate::denies('venue_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueCategoryResource($venueCategory);
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

        return (new VenueCategoryResource($venueCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VenueCategory $venueCategory)
    {
        abort_if(Gate::denies('venue_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}