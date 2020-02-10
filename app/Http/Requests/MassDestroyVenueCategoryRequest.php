<?php

namespace App\Http\Requests;

use App\VenueCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVenueCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:venue_categories,id',
        ];
    }
}