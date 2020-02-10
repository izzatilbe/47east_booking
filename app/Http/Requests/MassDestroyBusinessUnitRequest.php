<?php

namespace App\Http\Requests;

use App\BusinessUnit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessUnitRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_units,id',
        ];
    }
}