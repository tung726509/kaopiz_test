<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'sóng bắt đầu từ gió',
            'content' => 'Cuối trời mây trắng bay ,Lá vàng thưa thớt quá',
            'created_at' => Carbon::now()
        ]);
    }
}
