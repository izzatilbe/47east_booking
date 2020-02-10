<?php

namespace App\Http\Controllers\Admin;

use App\AccomTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccomTagRequest;
use App\Http\Requests\StoreAccomTagRequest;
use App\Http\Requests\UpdateAccomTagRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccomTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accom_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomTags = AccomTag::all();

        return view('admin.accomTags.index', compact('accomTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('accom_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accomTags.create');
    }

    public function store(StoreAccomTagRequest $request)
    {
        $accomTag = AccomTag::create($request->all());

        return redirect()->route('admin.accom-tags.index');
    }

    public function edit(AccomTag $accomTag)
    {
        abort_if(Gate::denies('accom_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accomTags.edit', compact('accomTag'));
    }

    public function update(UpdateAccomTagRequest $request, AccomTag $accomTag)
    {
        $accomTag->update($request->all());

        return redirect()->route('admin.accom-tags.index');
    }

    public function show(AccomTag $accomTag)
    {
        abort_if(Gate::denies('accom_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomTag->load('tagAccommodations');

        return view('admin.accomTags.show', compact('accomTag'));
    }

    public function destroy(AccomTag $accomTag)
    {
        abort_if(Gate::denies('accom_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accomTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccomTagRequest $request)
    {
        AccomTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}