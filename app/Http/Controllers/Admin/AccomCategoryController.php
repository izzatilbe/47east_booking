<?php

namespace App\Http\Controllers\Admin;

use App\AccomCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccomCategoryRequest;
use App\Http\Requests\StoreAccomCategoryRequest;
use App\Http\Requests\UpdateAccomCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccomCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accom_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomCategories = AccomCategory::all();

        return view('admin.accomCategories.index', compact('accomCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('accom_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accomCategories.create');
    }

    public function store(StoreAccomCategoryRequest $request)
    {
        $accomCategory = AccomCategory::create($request->all());

        return redirect()->route('admin.accom-categories.index');
    }

    public function edit(AccomCategory $accomCategory)
    {
        abort_if(Gate::denies('accom_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accomCategories.edit', compact('accomCategory'));
    }

    public function update(UpdateAccomCategoryRequest $request, AccomCategory $accomCategory)
    {
        $accomCategory->update($request->all());

        return redirect()->route('admin.accom-categories.index');
    }

    public function show(AccomCategory $accomCategory)
    {
        abort_if(Gate::denies('accom_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomCategory->load('categoryAccommodations');

        return view('admin.accomCategories.show', compact('accomCategory'));
    }

    public function destroy(AccomCategory $accomCategory)
    {
        abort_if(Gate::denies('accom_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccomCategoryRequest $request)
    {
        AccomCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}