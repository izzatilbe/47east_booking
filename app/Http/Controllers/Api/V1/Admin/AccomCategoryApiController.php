<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AccomCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAccomCategoryRequest;
use App\Http\Requests\UpdateAccomCategoryRequest;
use App\Http\Resources\Admin\AccomCategoryResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccomCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('accom_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccomCategoryResource(AccomCategory::all());
    }

    public function store(StoreAccomCategoryRequest $request)
    {
        $accomCategory = AccomCategory::create($request->all());

        if ($request->input('photo', false)) {
            $accomCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new AccomCategoryResource($accomCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AccomCategory $accomCategory)
    {
        abort_if(Gate::denies('accom_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccomCategoryResource($accomCategory);
    }

    public function update(UpdateAccomCategoryRequest $request, AccomCategory $accomCategory)
    {
        $accomCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (!$accomCategory->photo || $request->input('photo') !== $accomCategory->photo->file_name) {
                $accomCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($accomCategory->photo) {
            $accomCategory->photo->delete();
        }

        return (new AccomCategoryResource($accomCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AccomCategory $accomCategory)
    {
        abort_if(Gate::denies('accom_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}