<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Coworking;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoworkingRequest;
use App\Http\Requests\UpdateCoworkingRequest;
use App\Http\Resources\Admin\CoworkingResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoworkingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coworking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoworkingResource(Coworking::with(['booked_by'])->get());
    }

    public function store(StoreCoworkingRequest $request)
    {
        $coworking = Coworking::create($request->all());

        return (new CoworkingResource($coworking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Coworking $coworking)
    {
        abort_if(Gate::denies('coworking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoworkingResource($coworking->load(['booked_by']));
    }

    public function update(UpdateCoworkingRequest $request, Coworking $coworking)
    {
        $coworking->update($request->all());

        return (new CoworkingResource($coworking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Coworking $coworking)
    {
        abort_if(Gate::denies('coworking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coworking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}