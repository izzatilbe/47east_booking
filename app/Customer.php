<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'customers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'phone',
        'skype',
        'address',
        'website',
        'last_name',
        'first_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function bookedByDormitoryBookings()
    {
        return $this->hasMany(DormitoryBooking::class, 'booked_by_id', 'id');
    }

    public function bookedByVenueBookings()
    {
        return $this->hasMany(VenueBooking::class, 'booked_by_id', 'id');
    }

    public function bookedByStaycationBookings()
    {
        return $this->hasMany(StaycationBooking::class, 'booked_by_id', 'id');
    }

    public function bookedByCoworkings()
    {
        return $this->hasMany(Coworking::class, 'booked_by_id', 'id');
    }
}