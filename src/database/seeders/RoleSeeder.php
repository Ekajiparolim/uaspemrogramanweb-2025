<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Poli;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'dokter']);
        Role::firstOrCreate(['name' => 'pasien']);

        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('super_admin');

        $polis = [
            ['name' => 'Poli Umum', 'description' => 'Pelayanan umum'],
            ['name' => 'Poli Jantung', 'description' => 'Pemeriksaan jantung'],
            ['name' => 'Poli Mata', 'description' => 'Pemeriksaan mata'],
            ['name' => 'Poli Ortopedi', 'description' => 'Pemeriksaan tulang'],
        ];

        foreach ($polis as $poli) {
            Poli::firstOrCreate(['name' => $poli['name']], ['description' => $poli['description']]);
        }

        $dokters = [
            ['name' => 'Dr. Budi', 'email' => 'dokter@umum.com', 'poli_id' => 1],
            ['name' => 'Dr. Siti', 'email' => 'dokter@jantung.com', 'poli_id' => 2],
            ['name' => 'Dr. Andi', 'email' => 'dokter@mata.com', 'poli_id' => 3],
            ['name' => 'Dr. Rina', 'email' => 'dokter@ortopedi.com', 'poli_id' => 4],
        ];

        foreach ($dokters as $dokter) {
            $user = User::firstOrCreate(
                ['email' => $dokter['email']],
                [
                    'name' => $dokter['name'],
                    'password' => Hash::make('password'),
                    'poli_id' => $dokter['poli_id'],
                ]
            );
            $user->assignRole('dokter');
        }

         $pasiens = [
            ['name' => 'Eka', 'email' => 'pasien1@pasien.com'],
            ['name' => 'jpm', 'email' => 'pasien2@pasien.com'],
        ];

        foreach ($pasiens as $pasien) {
            $user = User::firstOrCreate([
                'name' => $pasien['name'],
                'email' => $pasien['email'],
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('pasien');
        }
    }
}
