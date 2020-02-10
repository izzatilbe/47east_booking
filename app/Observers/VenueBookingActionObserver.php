<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\VenueBooking;
use Illuminate\Support\Facades\Notification;

class VenueBookingActionObserver
{
    public function created(VenueBooking $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'VenueBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(VenueBooking $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'VenueBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(VenueBooking $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'VenueBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}