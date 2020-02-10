<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueAmenity extends Model
{
    use SoftDeletes;

    public $table = 'venue_amenities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function amenityVenues()
    {
        return $this->belongsToMany(Venue::class);
    }
}