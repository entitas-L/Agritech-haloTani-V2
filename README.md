# 🌾 Agritech HaloTani V2

Versi kustom dari **Agritech HaloTani**. Proyek ini dibuat buat ngembangin antarmuka (UI/UX) baru yang lebih segar, perbaikan alur di panel petani, dan tetep mempertahankan integrasi backend `KiraAIService` buat diagnosa keluhan tanaman secara otomatis.

---

## 💡 Fitur Utama

- 🤖 **Diagnosa Penyakit via Kira AI**: Panggil model `kira-mini-1.0` via Laravel HTTP Client buat dapet analisis penyakit & rekomendasi obat/tindakan secara otomatis.
- 👨‍🌾 **Panel Petani (Filament v3)**: Tampilan kustom yang simpel dan gampang dipake sama petani buat kirim keluhan lahan.
- 🔒 **Role Management**: Pemisahan akses antara akun Petani sama Admin.

---

## 🛠️ Stack yang Dipakai

- **Framework**: Laravel 11 / 12
- **Admin & User Panel**: Filament v3
- **Database**: MySQL
- **AI Integration**: Kira AI API (`kira-mini-1.0`)

---

## 🚀 Cara Setup di Lokal

1. **Clone repo & masuk ke folder:**
   ```bash
   git clone [https://github.com/entitas-L/Agritech-haloTani-V2.git](https://github.com/entitas-L/Agritech-haloTani-V2.git)
   cd Agritech-haloTani-V2