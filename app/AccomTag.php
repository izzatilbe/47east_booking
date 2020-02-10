<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccomTag extends Model
{
    use SoftDeletes;

    public $table = 'accom_tags';

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

    public function tagAccommodations()
    {
        return $this->belongsToMany(Accommodation::class);
    }
}