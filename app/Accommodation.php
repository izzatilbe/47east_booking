<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Accommodation extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'accommodations';

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
        'short_description',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function accomDormitoryBookings()
    {
        return $this->hasMany(DormitoryBooking::class, 'accom_id', 'id');
    }

    public function accomStaycationBookings()
    {
        return $this->hasMany(StaycationBooking::class, 'accom_id', 'id');
    }

    public function accomVenuePackages()
    {
        return $this->belongsToMany(VenuePackage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(AccomCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(AccomTag::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(AccomAmenity::class);
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