<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petani;
class PetaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Petani::firstOrNew(['email' => 'admin@agritech.test']);
        $admin->nama = 'Admin Agritech';
        $admin->password = 'password123';
        $admin->role = 'admin';
        $admin->save();


        Petani::firstOrCreate(
            ['email' => 'budi@agritech.test'],
            [
                'nama'     => 'Budi Santoso',
                'password' => 'password123',
                'kontak'   => '081234567890',
                'alamat'   => 'Desa Sukamaju, Madiun',
            ]
        );

    }
}
