<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class KiraAIService
{
    public static function generateSolusi(string $keluhanPetani, string $lokasiLahan): string
    {
        $apiKey = env('OPENROUTER_API_KEY') ?? config('services.openrouter.key');

        if (empty($apiKey)) {
            return 'ERROR: OPENROUTER_API_KEY belum terdeteksi!';
        }

        $prompt = "Kamu adalah asisten ahli pertanian 'Agritech Assistant'.\n" .
            "Lokasi Lahan: {$lokasiLahan}\n" .
            "Keluhan Tanaman: {$keluhanPetani}\n\n" .
            "ATURAN FORMATTING:\n" .
            "1. JANGAN gunakan simbol '•' inline dalam satu paragraf.\n" .
            "2. WAJIB gunakan format Markdown list (gunakan tanda '-' atau angka di baris baru) untuk setiap poin agar mudah dibaca.\n" .
            "3. Tulis jawaban secara ringkas, padat, dan langsung ke poin utama.";

        // Daftar model free cadangan (urut dari yang paling stabil)
        $models = [
            'nvidia/nemotron-3-ultra-550b-a55b:free',
            'nvidia/nemotron-3.5-lightning:free',
            'poolside/laguna-s-2.1:free',
        ];

        foreach ($models as $model) {
            try {
                $response = Http::timeout(20) // Cukup 20 detik per model biar cepat pindah
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $apiKey,
                        'HTTP-Referer'  => 'http://localhost',
                        'Content-Type'  => 'application/json',
                    ])
                    ->post('https://openrouter.ai/api/v1/chat/completions', [
                        'model' => $model,
                        'messages' => [
                            ['role' => 'user', 'content' => $prompt]
                        ],
                        'max_tokens' => 1000,
                        'temperature' => 0.7,
                    ]);

                if ($response->successful() && !empty($response->json('choices.0.message.content'))) {
                    return $response->json('choices.0.message.content');
                }
            } catch (\Exception $e) {
                // Jika model ini timeout/error, loop akan lanjut mencoba model berikutnya
                continue;
            }
        }

        return 'Sistem AI sedang mengalami antrean padat di semua server. Silakan klik tombol analisis sekali lagi.';
    }
}