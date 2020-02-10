<?php

namespace App\Http\Requests;

use App\Accommodation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAccommodationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accommodation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'              => [
                'required'],
            'short_description' => [
                'min:5',
                'max:255',
                'required'],
            'categories.*'      => [
                'integer'],
            'categories'        => [
                'required',
                'array'],
            'tags.*'            => [
                'integer'],
            'tags'              => [
                'array'],
            'description'       => [
                'required'],
            'capacity'          => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'amenities.*'       => [
                'integer'],
            'amenities'         => [
                'array'],
            'price'             => [
                'required'],
            'photo.*'           => [
                'required'],
        ];
    }
}