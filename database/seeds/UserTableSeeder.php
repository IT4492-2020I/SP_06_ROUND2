<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory('App\Models\User', 10)->create();
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'avata_url' => '2',
            'password' => \Hash::make('123456'),
            'address' => 'Bach Khoa, Hai Ba Trung, Ha Noi',
            'phone' => '0123456789',
            'role' => 1,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);
    }
}
