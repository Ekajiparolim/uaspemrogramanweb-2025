<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poli::create([
            'name' => 'Poli Umum',
            'description' => 'Untuk keluhan kesehatan umum.',
        ]);
        Poli::create([
            'name' => 'Poli Jantung',
            'description' => 'Spesialis penyakit jantung dan pembuluh darah.',
            ]);
        Poli::create([
            'name' => 'Poli Mata',
            'description' => 'Spesialis kesehatan mata.',
            ]);
        Poli::create([
            'name' => 'Poli Ortopedi',
            'description' => 'Spesialis tulang, sendi, dan otot.',
            ]);
    }
}
