<?php

namespace App\Http\Requests;

use App\DormitoryBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDormitoryBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dormitory_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:dormitory_bookings,id',
        ];
    }
}