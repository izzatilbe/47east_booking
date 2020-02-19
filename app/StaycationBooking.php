<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaycationBooking extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'staycation_bookings';

    const PACKAGE_RADIO = [
        'yes' => 'Yes',
        'no'  => 'No',
    ];

    protected $dates = [
        'check_in',
        'check_out',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const BOOKING_STATUS_RADIO = [
        'confirmed'   => 'Confirmed',
        'pending'     => 'Pending',
        'for_payment' => 'For Payment',
        'cancelled'   => 'Cancelled',
    ];

    protected $fillable = [
        'package',
        'accom_id',
        'check_in',
        'duration',
        'quantity',
        'check_out',
        'created_at',
        'updated_at',
        'deleted_at',
        'room_charge',
        'misc_charge',
        'booked_by_id',
        'total_charge',
        'booking_status',
    ];

    public static function boot()
    {
        parent::boot();

        StaycationBooking::observe(new \App\Observers\StaycationBookingActionObserver);
    }

    public function accomVenuePackages()
    {
        return $this->belongsToMany(VenuePackage::class);
    }

    public function booked_by()
    {
        return $this->belongsTo(Customer::class, 'booked_by_id');
    }

    public function accom()
    {
        return $this->belongsTo(Accommodation::class, 'accom_id');
    }
    
    public function getCheckInAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCheckInAttribute($value)
    {
        $this->attributes['check_in'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCheckOutAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCheckOutAttribute($value)
    {
        $this->attributes['check_out'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}