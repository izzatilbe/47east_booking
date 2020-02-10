<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\BusinessUnit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessUnitRequest;
use App\Http\Requests\UpdateBusinessUnitRequest;
use App\Http\Resources\Admin\BusinessUnitResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessUnitApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessUnitResource(BusinessUnit::all());
    }

    public function store(StoreBusinessUnitRequest $request)
    {
        $businessUnit = BusinessUnit::create($request->all());

        return (new BusinessUnitResource($businessUnit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BusinessUnit $businessUnit)
    {
        abort_if(Gate::denies('business_unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessUnitResource($businessUnit);
    }

    public function update(UpdateBusinessUnitRequest $request, BusinessUnit $businessUnit)
    {
        $businessUnit->update($request->all());

        return (new BusinessUnitResource($businessUnit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BusinessUnit $businessUnit)
    {
        abort_if(Gate::denies('business_unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessUnit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}