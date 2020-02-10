<?php

namespace App\Http\Requests;

use App\Venue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVenueRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'         => [
                'required'],
            'categories.*' => [
                'integer'],
            'categories'   => [
                'array'],
            'tags.*'       => [
                'integer'],
            'tags'         => [
                'array'],
            'description'  => [
                'required'],
            'capacity'     => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'amenities.*'  => [
                'integer'],
            'amenities'    => [
                'array'],
            'price'        => [
                'required'],
        ];
    }
}