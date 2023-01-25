<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            ['name' => 'member_1','email' => 'member_1@gmail.com','position' => 'coach'],
            ['name' => 'member_2','email' => 'member_2@gmail.com','position' => 'player'],
            ['name' => 'member_3','email' => 'member_3@gmail.com','position' => 'player'],
            ['name' => 'member_4','email' => 'member_4@gmail.com','position' => 'player'],
            ['name' => 'member_5','email' => 'member_5@gmail.com','position' => 'coach'],
            ['name' => 'member_6','email' => 'member_6@gmail.com','position' => 'player'],
            ['name' => 'member_7','email' => 'member_7@gmail.com','position' => 'player'],
            ['name' => 'member_8','email' => 'member_8@gmail.com','position' => 'player'],
        ]);
    }
}
