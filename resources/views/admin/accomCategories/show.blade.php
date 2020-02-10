@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accomCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accom-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accomCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $accomCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accomCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $accomCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accomCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $accomCategory->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accomCategory.fields.photo') }}
                        </th>
                        <td>
                            @if($accomCategory->photo)
                                <a href="{{ $accomCategory->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $accomCategory->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accom-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#category_accommodations" role="tab" data-toggle="tab">
                {{ trans('cruds.accommodation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="category_accommodations">
            @includeIf('admin.accomCategories.relationships.categoryAccommodations', ['accommodations' => $accomCategory->categoryAccommodations])
        </div>
    </div>
</div>

@endsection