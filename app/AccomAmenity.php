<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccomAmenity extends Model
{
    use SoftDeletes;

    public $table = 'accom_amenities';

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

    public function amenityAccommodations()
    {
        return $this->belongsToMany(Accommodation::class);
    }
}