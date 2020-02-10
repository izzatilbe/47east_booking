<?php

namespace App\Http\Controllers\Admin;

use App\AccomCategory;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccomCategoryRequest;
use App\Http\Requests\StoreAccomCategoryRequest;
use App\Http\Requests\UpdateAccomCategoryRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AccomCategoryController extends Controller
{
    use MediaUploadingTrait;

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

        if ($request->input('photo', false)) {
            $accomCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $accomCategory->id]);
        }

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

        if ($request->input('photo', false)) {
            if (!$accomCategory->photo || $request->input('photo') !== $accomCategory->photo->file_name) {
                $accomCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($accomCategory->photo) {
            $accomCategory->photo->delete();
        }

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accom_category_create') && Gate::denies('accom_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AccomCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}