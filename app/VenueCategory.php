<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueCategory extends Model
{
    use SoftDeletes;

    public $table = 'venue_categories';

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

    public function categoryVenues()
    {
        return $this->belongsToMany(Venue::class);
    }
}