<?php

namespace App\Http\Requests;

use App\VenueBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVenueBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'datetime_start' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')],
            'datetime_end'   => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')],
            'duration'       => [
                'required'],
            'room_charge'    => [
                'required'],
            'total_charge'   => [
                'required'],
            'booking_status' => [
                'required'],
        ];
    }
}