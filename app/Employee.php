<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'employees';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'password',
        'position',
        'last_name',
        'first_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'business_unit_id',
    ];

    public function business_unit()
    {
        return $this->belongsTo(BusinessUnit::class, 'business_unit_id');
    }
}