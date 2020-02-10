<?php

namespace App\Http\Requests;

use App\VenueAmenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVenueAmenityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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