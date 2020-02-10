<?php

namespace App\Http\Requests;

use App\VenueTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVenueTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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