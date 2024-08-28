<?php

namespace welabs\SalatNotifier\database;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalatTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       
        $salatTimes =  [
            ['salat' => 'Fajr', 'time' => '04:25:00'], 
            ['salat' => 'Dhuhr', 'time' => '13:30:00'], 
            ['salat' => 'Asr', 'time' => '16:45:00'], 
            ['salat' => 'Maghrib', 'time' => '18:40:00'], 
            ['salat' => 'Isha', 'time' => '20:30:00'], 
        ];
 
        DB::table('salat_times')->insert($salatTimes);

    }
}
