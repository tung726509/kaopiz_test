<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'tungvs',
            'email' => 'anonymous101229722@gmail.com',
            'password' => '$2y$10$NCuTSMo3bHikJ10J.jAtAOtJEo5.ChI6Iq.b.ImwjvfGB8AaqDdKq',
            'created_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'kaopiz',
            'email' => 'kaopiz@gmail.com',
            'password' => '$2y$10$NCuTSMo3bHikJ10J.jAtAOtJEo5.ChI6Iq.b.ImwjvfGB8AaqDdKq',
            'created_at' => Carbon::now()
        ]);
    }
}
