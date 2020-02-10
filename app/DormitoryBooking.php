<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DormitoryBooking extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'dormitory_bookings';

    protected $dates = [
        'move_in',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const DURATION_MONTHS_RADIO = [
        '6'  => '6 Months',
        '12' => '12 Months',
    ];

    const PAYMENT_TYPE_RADIO = [
        'cash' => 'Cash',
        'card' => 'Credit Card',
    ];

    const BOOKING_STATUS_RADIO = [
        'confirmed'   => 'Confirmed',
        'pending'     => 'Pending',
        'for_payment' => 'For Payment',
        'cancelled'   => 'Cancelled',
    ];

    protected $fillable = [
        'move_in',
        'accom_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'room_charge',
        'misc_charge',
        'booked_by_id',
        'total_charge',
        'payment_type',
        'booking_status',
        'duration_months',
    ];

    public static function boot()
    {
        parent::boot();

        DormitoryBooking::observe(new \App\Observers\DormitoryBookingActionObserver);
    }

    public function accom()
    {
        return $this->belongsTo(Accommodation::class, 'accom_id');
    }

    public function booked_by()
    {
        return $this->belongsTo(Customer::class, 'booked_by_id');
    }

    public function getMoveInAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMoveInAttribute($value)
    {
        $this->attributes['move_in'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}