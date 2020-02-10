<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueBooking extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'venue_bookings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'datetime_end',
        'datetime_start',
    ];

    const PAYMENT_TYPE_RADIO = [
        'cash'     => 'Cash',
        'card'     => 'Credit Card',
        'internal' => 'Internal',
    ];

    const BOOKING_STATUS_RADIO = [
        'confirmed'   => 'Confirmed',
        'pending'     => 'Pending',
        'for_payment' => 'For Payment',
        'cancelled'   => 'Cancelled',
    ];

    protected $fillable = [
        'duration',
        'created_at',
        'updated_at',
        'deleted_at',
        'room_charge',
        'misc_charge',
        'booked_by_id',
        'datetime_end',
        'total_charge',
        'payment_type',
        'datetime_start',
        'booking_status',
    ];

    public static function boot()
    {
        parent::boot();

        VenueBooking::observe(new \App\Observers\VenueBookingActionObserver);
    }

    public function venueVenuePackages()
    {
        return $this->belongsToMany(VenuePackage::class);
    }

    public function booked_by()
    {
        return $this->belongsTo(Customer::class, 'booked_by_id');
    }

    public function getDatetimeStartAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDatetimeStartAttribute($value)
    {
        $this->attributes['datetime_start'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDatetimeEndAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDatetimeEndAttribute($value)
    {
        $this->attributes['datetime_end'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}