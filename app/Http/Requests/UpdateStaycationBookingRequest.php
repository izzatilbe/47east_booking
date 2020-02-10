<?php

namespace App\Http\Requests;

use App\StaycationBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateStaycationBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('staycation_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'accom_id'       => [
                'required',
                'integer'],
            'check_in'       => [
                'required',
                'date_format:' . config('panel.date_format')],
            'check_out'      => [
                'required',
                'date_format:' . config('panel.date_format')],
            'duration'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'quantity'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'room_charge'    => [
                'required'],
            'total_charge'   => [
                'required'],
            'booking_status' => [
                'required'],
        ];
    }
}