<?php

namespace App\Http\Controllers\Admin;

use App\BusinessUnit;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBusinessUnitRequest;
use App\Http\Requests\StoreBusinessUnitRequest;
use App\Http\Requests\UpdateBusinessUnitRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessUnitController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessUnits = BusinessUnit::all();

        return view('admin.businessUnits.index', compact('businessUnits'));
    }

    public function create()
    {
        abort_if(Gate::denies('business_unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessUnits.create');
    }

    public function store(StoreBusinessUnitRequest $request)
    {
        $businessUnit = BusinessUnit::create($request->all());

        return redirect()->route('admin.business-units.index');
    }

    public function edit(BusinessUnit $businessUnit)
    {
        abort_if(Gate::denies('business_unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.businessUnits.edit', compact('businessUnit'));
    }

    public function update(UpdateBusinessUnitRequest $request, BusinessUnit $businessUnit)
    {
        $businessUnit->update($request->all());

        return redirect()->route('admin.business-units.index');
    }

    public function show(BusinessUnit $businessUnit)
    {
        abort_if(Gate::denies('business_unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessUnit->load('businessUnitEmployees');

        return view('admin.businessUnits.show', compact('businessUnit'));
    }

    public function destroy(BusinessUnit $businessUnit)
    {
        abort_if(Gate::denies('business_unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessUnit->delete();

        return back();
    }

    public function massDestroy(MassDestroyBusinessUnitRequest $request)
    {
        BusinessUnit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}