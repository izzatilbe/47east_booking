<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Venue extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'venues';

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'capacity',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function venueVenuePackages()
    {
        return $this->belongsToMany(VenuePackage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(VenueCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(VenueTag::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(VenueAmenity::class);
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }
}