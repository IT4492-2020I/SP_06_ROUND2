<?php

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::truncate();
        factory('App\Models\OrderDetail', 10)->create();
    }
}
