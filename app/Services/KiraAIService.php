<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class KiraAIService
{
    public static function generateSolusi(string $keluhanPetani, string $lokasiLahan): string
    {
        $apiKey = env('CEREBRAS_API_KEY') ?? config('services.cerebras.key');

        if (empty($apiKey)) {
            return 'ERROR: API Key (Cerebras / OpenRouter) belum terdeteksi di .env!';
        }

        $prompt = "Kamu adalah asisten ahli pertanian 'Agritech Assistant'.\n" .
            "Lokasi Lahan: {$lokasiLahan}\n" .
            "Keluhan Tanaman: {$keluhanPetani}\n\n" .
            "ATURAN FORMATTING:\n" .
            "1. JANGAN gunakan simbol '•' inline dalam satu paragraf.\n" .
            "2. WAJIB gunakan format Markdown list (gunakan tanda '-' atau angka di baris baru) untuk setiap poin agar mudah dibaca.\n" .
            "3. Tulis jawaban secara ringkas, padat, dan langsung ke poin utama.";

        $models = [
            'gpt-oss-120b'
        ];

        foreach ($models as $model) {
            try {
                $response = Http::timeout(20) // Cukup 20 detik per model biar cepat pindah
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $apiKey,
                        'HTTP-Referer'  => 'http://localhost',
                        'Content-Type'  => 'application/json',
                    ])
                    ->post('https://api.cerebras.ai/v1/chat/completions', [
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