<?php

namespace App\Http\Requests;

use App\AccomCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAccomCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accom_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:accom_categories,id',
        ];
    }
}