<?php

namespace Database\Seeders;

use App\Models\Petani;
use App\Models\TemplatePrompt;
use Illuminate\Database\Seeder;

class TemplatePromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (TemplatePrompt::count() > 0) {
            return;
        }

        $admin = Petani::where('email', 'admin@agritech.test')->first();

        TemplatePrompt::create([
            'id_petani' => $admin->id_petani,
            'isi_template' => "Kamu adalah penyuluh pertanian yang membantu petani.\n"
                . "Jenis tanaman: {jenis_tanaman}\n"
                . "Lokasi: {lokasi}\n"
                . "Tingkat urgensi: {urgensi}\n"
                . "Keluhan petani: {keluhan}\n\n"
                . "Berikan analisis penyebab masalah dan rekomendasi penanganan "
                . "dengan bahasa sederhana yang mudah dipahami petani.",
        ]);
    }
}
