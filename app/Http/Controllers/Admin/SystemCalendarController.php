<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\DormitoryBooking',
            'date_field' => 'move_in',
            'field'      => 'id',
            'prefix'     => 'D:',
            'suffix'     => 'move in',
            'route'      => 'admin.dormitory-bookings.edit',
        ],
        [
            'model'      => '\\App\\StaycationBooking',
            'date_field' => 'check_in',
            'field'      => 'id',
            'prefix'     => 'S:',
            'suffix'     => 'check in',
            'route'      => 'admin.staycation-bookings.edit',
        ],
        [
            'model'      => '\\App\\StaycationBooking',
            'date_field' => 'check_out',
            'field'      => 'id',
            'prefix'     => 'S:',
            'suffix'     => 'check out',
            'route'      => 'admin.staycation-bookings.edit',
        ],
        [
            'model'      => '\\App\\VenueBooking',
            'date_field' => 'datetime_start',
            'field'      => 'id',
            'prefix'     => 'V:',
            'suffix'     => 'start',
            'route'      => 'admin.venue-bookings.edit',
        ],
        [
            'model'      => '\\App\\VenueBooking',
            'date_field' => 'datetime_end',
            'field'      => 'id',
            'prefix'     => 'V:',
            'suffix'     => 'end',
            'route'      => 'admin.venue-bookings.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}