<?php

namespace App\Http\Requests;

use App\VenuePackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVenuePackageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:venue_packages,id',
        ];
    }
}