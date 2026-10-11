# Agritech haloTani V2

Aplikasi manajemen dan asistensi sistem pertanian cerdas berbasis Laravel.

## 🤖 AI Service Integration

Sistem asistensi pertanian pada versi **V2** ini didesain secara dinamis dan fleksibel (*Provider-Agnostic AI Integration*).

### Fitur AI Assistant:
- **Primary / Fallback Provider**: Mendukung integrasi via **OpenRouter Gateway** (Nvidia Nemotron 3.5 Lightning / Google Gemini / Llama) serta **Kira AI Service**.
- **Fitur Utama**: Analisis penyakit tanaman berdasarkan deskripsi keluhan petani dan estimasi wilayah lahan, lengkap dengan rekomendasi penanganan praktis.

## 🤖 Fitur Utama: Konsultasi Agritech AI

Sistem ini dilengkapi dengan asisten cerdas berbasis Artificial Intelligence untuk membantu menganalisis keluhan tanaman dan memberikan rekomendasi perawatan secara akurat.

### Keunggulan Integrasi AI:
- **Multi-Model Fallback System**: Menggunakan strategi toleransi kesalahan (fault tolerance) dengan otomatis dialihkan ke model cadangan (Meta Llama 3.2, Google Gemma 2, Qwen 2.5) jika terjadi latency/timeout pada API utama.
- **Graceful Error Handling**: Mencegah kegagalan sistem (HTTP 500) saat terjadi gangguan jaringan atau antrean padat di server AI.
- **Data Persistence**: Hasil analisis AI dan keluhan pengguna disimpan secara permanen ke MySQL (`keluhan` table) menggunakan skema UUID dan penampungan teks panjang (`LONGTEXT`).
- **Markdown Rendering**: Jawaban AI diformat secara otomatis menggunakan penulisan Markdown agar mudah dibaca oleh pengguna.

### Tech Stack AI Integration
- **Framework & UI**: Laravel 11, Filament v3, Livewire
- **AI Gateway**: OpenRouter API (`chat/completions`)
- **HTTP Client**: Laravel Http Facade (cURL Wrapper with dynamic timeout)

### Konfigurasi `.env`

Untuk mengaktifkan integrasi AI via OpenRouter:

```env
# OpenRouter / Multi-Model AI Gateway
OPENROUTER_API_KEY=sk-or-v1-your-api-key-here
OPENROUTER_MODEL=nvidia/nemotron-3.5-lightning:free