<?php

namespace App\Http\Requests;

use App\BusinessUnit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBusinessUnitRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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