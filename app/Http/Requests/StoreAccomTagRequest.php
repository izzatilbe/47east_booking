<?php

namespace App\Http\Requests;

use App\AccomTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAccomTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accom_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required'],
        ];
    }
}