<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenuePackage extends Model
{
    use SoftDeletes;

    public $table = 'venue_packages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'updated_at',
        'created_at',
        'deleted_at',
        'total_package_charge',
    ];

    public static function boot()
    {
        parent::boot();

        VenuePackage::observe(new \App\Observers\VenuePackageActionObserver);
    }

    public function accoms()
    {
        return $this->belongsToMany(StaycationBooking::class);
    }

    public function venues()
    {
        return $this->belongsToMany(VenueBooking::class);
    }
}