<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JanjiTemu;

class JanjiTemuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JanjiTemu::create([
            'pasien_id' => 6,  
            'poli_id'   => 1,     
            'dokter_id' => 2,   
            'hari'   => 'Senin',
            'jam'       => '09:00:00',
        ]);

        JanjiTemu::create([
            'pasien_id' => 7,   
            'poli_id'   => 2,     
            'dokter_id' => 3,     
            'hari'   => 'Rabu',
            'jam'       => '10:00:00',
        ]);
    }
}
