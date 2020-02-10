<?php

namespace App\Http\Requests;

use App\AccomTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAccomTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accom_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:accom_tags,id',
        ];
    }
}