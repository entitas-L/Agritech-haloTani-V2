# Agritech haloTani V2

Aplikasi manajemen dan asistensi sistem pertanian cerdas berbasis Laravel.

## 🤖 AI Service Integration

Sistem asistensi pertanian pada versi **V2** ini didesain secara dinamis dan fleksibel (*Provider-Agnostic AI Integration*).

### Fitur AI Assistant:
- **Primary / Fallback Provider**: Mendukung integrasi via **OpenRouter Gateway** (Nvidia Nemotron 3.5 Lightning / Google Gemini / Llama) serta **Kira AI Service**.
- **Fitur Utama**: Analisis penyakit tanaman berdasarkan deskripsi keluhan petani dan estimasi wilayah lahan, lengkap dengan rekomendasi penanganan praktis.

### Konfigurasi `.env`

Untuk mengaktifkan integrasi AI via OpenRouter:

```env
# OpenRouter / Multi-Model AI Gateway
OPENROUTER_API_KEY=sk-or-v1-your-api-key-here
OPENROUTER_MODEL=nvidia/nemotron-3.5-lightning:free