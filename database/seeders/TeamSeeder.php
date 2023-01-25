<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            ['name' => 'Team_01'],
            ['name' => 'Team_02'],
            ['name' => 'Team_03'],
            ['name' => 'Team_04'],
            ['name' => 'Team_05'],
        ]);
    }
}
