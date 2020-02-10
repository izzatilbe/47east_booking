<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AccomTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccomTagRequest;
use App\Http\Requests\UpdateAccomTagRequest;
use App\Http\Resources\Admin\AccomTagResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccomTagApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accom_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccomTagResource(AccomTag::all());
    }

    public function store(StoreAccomTagRequest $request)
    {
        $accomTag = AccomTag::create($request->all());

        return (new AccomTagResource($accomTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AccomTag $accomTag)
    {
        abort_if(Gate::denies('accom_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccomTagResource($accomTag);
    }

    public function update(UpdateAccomTagRequest $request, AccomTag $accomTag)
    {
        $accomTag->update($request->all());

        return (new AccomTagResource($accomTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AccomTag $accomTag)
    {
        abort_if(Gate::denies('accom_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}