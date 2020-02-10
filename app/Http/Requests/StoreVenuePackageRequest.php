<?php

namespace App\Http\Requests;

use App\VenuePackage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVenuePackageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'accoms.*'             => [
                'integer'],
            'accoms'               => [
                'required',
                'array'],
            'venues.*'             => [
                'integer'],
            'venues'               => [
                'required',
                'array'],
            'total_package_charge' => [
                'required'],
        ];
    }
}