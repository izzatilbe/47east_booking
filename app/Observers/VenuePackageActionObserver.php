<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\VenuePackage;
use Illuminate\Support\Facades\Notification;

class VenuePackageActionObserver
{
    public function created(VenuePackage $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'VenuePackage'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(VenuePackage $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'VenuePackage'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(VenuePackage $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'VenuePackage'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
