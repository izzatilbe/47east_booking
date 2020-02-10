<?php

namespace App\Http\Requests;

use App\VenueAmenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVenueAmenityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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