<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccomCategory extends Model
{
    use SoftDeletes;

    public $table = 'accom_categories';

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

    public function categoryAccommodations()
    {
        return $this->belongsToMany(Accommodation::class);
    }
}