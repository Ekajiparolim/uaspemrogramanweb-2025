<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $umum = Poli::where('name', 'Poli Umum')->first();
        $jantung = Poli::where('name', 'Poli Jantung')->first();
        $mata = Poli::where('name', 'Poli Mata')->first();
        $ortopedi = Poli::where('name', 'Poli Ortopedi')->first();

        Jadwal::create([
            'poli_id' => $umum->id,
            'hari' => 'Senin',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $umum->id,
            'hari' => 'Selasa',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $jantung->id,
            'hari' => 'Selasa',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $jantung->id,
            'hari' => 'Rabu',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $mata->id,
            'hari' => 'Rabu',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $mata->id,
            'hari' => 'Kamis',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $ortopedi->id,
            'hari' => 'Kamis',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);

        Jadwal::create([
            'poli_id' => $ortopedi->id,
            'hari' => 'Jumat',
            'jam_mulai' => '09:00',
            'jam_selesai' => '16:00',
        ]);
    }
}
