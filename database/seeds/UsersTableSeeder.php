<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$xQ8z.qp1tE7wa/9Soklsy.BDhEn5i5hy4JftZ5KClXeZWEuxe.5EG',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}