<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coworking extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'coworkings';

    protected $dates = [
        'date_end',
        'date_start',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PASS_TYPE_RADIO = [
        'day'   => '1-Day Pass',
        'month' => '1-Month Pass',
        'year'  => '1-Year Pass',
    ];

    const BOOKING_STATUS_RADIO = [
        'confirmed'   => 'Confirmed',
        'pending'     => 'Pending',
        'for_payment' => 'For Payment',
        'cancelled'   => 'Cancelled',
    ];

    protected $fillable = [
        'date_end',
        'duration',
        'quantity',
        'pass_type',
        'date_start',
        'created_at',
        'updated_at',
        'deleted_at',
        'booked_by_id',
        'total_charge',
        'booking_status',
    ];

    public static function boot()
    {
        parent::boot();

        Coworking::observe(new \App\Observers\CoworkingActionObserver);
    }

    public function booked_by()
    {
        return $this->belongsTo(Customer::class, 'booked_by_id');
    }

    public function getDateStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}