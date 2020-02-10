<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AccomAmenity;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAccomAmenityRequest;
use App\Http\Requests\UpdateAccomAmenityRequest;
use App\Http\Resources\Admin\AccomAmenityResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccomAmenityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('accom_amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccomAmenityResource(AccomAmenity::all());
    }

    public function store(StoreAccomAmenityRequest $request)
    {
        $accomAmenity = AccomAmenity::create($request->all());

        if ($request->input('photo', false)) {
            $accomAmenity->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new AccomAmenityResource($accomAmenity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AccomAmenity $accomAmenity)
    {
        abort_if(Gate::denies('accom_amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccomAmenityResource($accomAmenity);
    }

    public function update(UpdateAccomAmenityRequest $request, AccomAmenity $accomAmenity)
    {
        $accomAmenity->update($request->all());

        if ($request->input('photo', false)) {
            if (!$accomAmenity->photo || $request->input('photo') !== $accomAmenity->photo->file_name) {
                $accomAmenity->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($accomAmenity->photo) {
            $accomAmenity->photo->delete();
        }

        return (new AccomAmenityResource($accomAmenity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AccomAmenity $accomAmenity)
    {
        abort_if(Gate::denies('accom_amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomAmenity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}