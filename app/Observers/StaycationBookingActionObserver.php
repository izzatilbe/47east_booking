<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\StaycationBooking;
use Illuminate\Support\Facades\Notification;

class StaycationBookingActionObserver
{
    public function created(StaycationBooking $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'StaycationBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(StaycationBooking $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'StaycationBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(StaycationBooking $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'StaycationBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}