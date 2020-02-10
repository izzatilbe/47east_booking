<?php

namespace App\Observers;

use App\DormitoryBooking;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class DormitoryBookingActionObserver
{
    public function created(DormitoryBooking $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'DormitoryBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(DormitoryBooking $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'DormitoryBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(DormitoryBooking $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'DormitoryBooking'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}