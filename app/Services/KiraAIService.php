<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KiraAIService
{
    public static function generateSolusi(string $keluhanPetani, string $lokasiLahan): string
    {
        // Ambil key dari config atau langsung dari env jika config null
        $apiKey = config('services.kira.key') ?? env('KIRA_API_KEY');

        // Jika API Key tidak terdeteksi
        if (empty($apiKey)) {
            return 'ERROR: KIRA_API_KEY belum terdeteksi di .env atau config/services.php!';
        }
        $prompt = "Kamu adalah asisten ahli pertanian 'Agritech Assistant'.\n" .
                  "Lokasi Lahan: {$lokasiLahan}\n" .
                  "Keluhan Tanaman: {$keluhanPetani}\n\n" .
                  "Berikan analisis penyakit/masalah dan rekomendasi penanganan yang praktis untuk petani.";

            // Tambahkan timeout 60 detik sebelum dipost
            $response = Http::timeout(60)
                ->connectTimeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . trim($apiKey),
                    'Content-Type'  => 'application/json',
                ])->post('https://kiraai.vn/api/v1', [
                    'model' => 'kira-mini-1.0',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Kamu adalah Agritech Assistant, asisten sistem pertanian cerdas.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.7,
                ]);

        if ($response->successful()) {
            return $response->json('choices.0.message.content') 
                   ?? 'Gagal mengekstrak rekomendasi dari AI.';
        }

        return 'Error Code ' . $response->status() . ': ' . $response->body();
    }
}