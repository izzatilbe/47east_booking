<?php

namespace App\Http\Requests;

use App\Accommodation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAccommodationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accommodation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:accommodations,id',
        ];
    }
}