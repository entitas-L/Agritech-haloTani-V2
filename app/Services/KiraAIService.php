<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KiraAIService
{
    public static function generateSolusi(string $keluhanPetani, string $lokasiLahan): string
    {
        // Ambil API Key dan Model dari config/services.php
        $apiKey = config('services.openrouter.key');
        $model = config('services.openrouter.model', 'nvidia/nemotron-3.5-lightning');

        // Jika API Key tidak terdeteksi
        if (empty($apiKey)) {
            return 'ERROR: OPENROUTER_API_KEY belum terdeteksi di .env atau config/services.php!';
        }

        $prompt = "Kamu adalah asisten ahli pertanian 'Agritech Assistant'.\n" .
                  "Lokasi Lahan: {$lokasiLahan}\n" .
                  "Keluhan Tanaman: {$keluhanPetani}\n\n" .
                  "Berikan analisis penyakit dan rekomendasi penanganan yang ringkas, padat, to the point, dan langsung menggunakan poin-poin utama tanpa pengantar panjang agar muat dalam satu tanggapan.";

        // Endpoint resmi Gemini REST API (API key dilewatkan via query param ?key=)
        $url = "https://openrouter.ai/api/v1/chat/completions";

        // Request HTTP murni tanpa Header Bearer Authorization
        $response = Http::timeout(60)
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'HTTP-Referer'  => 'http://localhost', 
                'Content-Type'  => 'application/json',
        ])
        ->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => env('OPENROUTER_MODEL', 'nvidia/nemotron-3.5-lightning'),
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],

            'max_tokens' => 8192, // <--- NAIKIN KE 3000 ATAU 4096 BIAR PANJANG & TUNTAS
            'temperature' => 0.7,
        ]);

        if ($response->successful()) {
            return $response->json('choices.0.message.content') 
                   ?? 'Gagal mengekstrak rekomendasi dari Gemini AI.';
        }

        return 'Error Code ' . $response->status() . ': ' . $response->body();
    }
}