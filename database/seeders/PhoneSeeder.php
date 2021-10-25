<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phones')->insert([
            'user_id' => 1,
            'number' => '0329585709',
        ]);
        DB::table('phones')->insert([
            'user_id' => 2,
            'number' => '0329585700',
        ]);
    }
}
