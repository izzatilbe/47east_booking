<?php

namespace App\Http\Requests;

use App\DormitoryBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDormitoryBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dormitory_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'accom_id'        => [
                'required',
                'integer'],
            'duration_months' => [
                'required'],
            'move_in'         => [
                'required',
                'date_format:' . config('panel.date_format')],
            'room_charge'     => [
                'required'],
            'total_charge'    => [
                'required'],
            'booking_status'  => [
                'required'],
        ];
    }
}