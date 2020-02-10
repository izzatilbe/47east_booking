<?php

namespace App\Http\Requests;

use App\AccomAmenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAccomAmenityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accom_amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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