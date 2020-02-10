<?php

namespace App\Http\Requests;

use App\VenueTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVenueTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:venue_tags,id',
        ];
    }
}