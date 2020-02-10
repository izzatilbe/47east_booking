<?php

namespace App\Http\Requests;

use App\Coworking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCoworkingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('coworking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'booked_by_id'   => [
                'required',
                'integer'],
            'date_start'     => [
                'required',
                'date_format:' . config('panel.date_format')],
            'date_end'       => [
                'required',
                'date_format:' . config('panel.date_format')],
            'duration'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'quantity'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'total_charge'   => [
                'required'],
            'booking_status' => [
                'required'],
            'pass_type'      => [
                'required'],
        ];
    }
}