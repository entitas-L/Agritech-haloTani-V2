# Agritech Assistant (HaloTani)

Aplikasi konsultasi keluhan petani dengan bantuan layanan AI. Petani menulis
keluhan tanamannya, lalu sistem memberi analisis dan rekomendasi penanganan.

Proyek kelas 2-A, Politeknik Negeri Madiun.

**Teknologi:** PHP 8.3, Laravel 13, Filament 5, MySQL, Livewire, Tailwind CSS.

## Daftar Isi

1. [Prasyarat](#1-prasyarat)
2. [Menjalankan proyek pertama kali](#2-menjalankan-proyek-pertama-kali)
3. [Akun uji coba](#3-akun-uji-coba)
4. [Setelah git pull](#4-setelah-git-pull)
5. [Peta folder](#5-peta-folder)
6. [Menambah fitur dengan Filament](#6-menambah-fitur-dengan-filament)
7. [Aturan kerja Git](#7-aturan-kerja-git)
8. [Catatan untuk tiap peran](#8-catatan-untuk-tiap-peran)
9. [Masalah yang sering muncul](#9-masalah-yang-sering-muncul)
10. [Status fitur](#10-status-fitur)

---

## 1. Prasyarat

- Laragon (berisi PHP 8.3, MySQL, Composer, dan Node.js)
- Git
- VS Code atau editor lain

Cek versi di terminal:

```
php -v
composer -V
node -v
git --version
```

PHP harus 8.3 atau lebih baru.

---

## 2. Menjalankan proyek pertama kali

1. Buka Laragon, klik **Start All**. MySQL harus berjalan.

2. Ambil kode:

```
cd C:\laragon\www
git clone <alamat-repositori>
cd Agritech_HaloTani
```

3. Pasang paket:

```
composer install
npm install
```

4. Buat file pengaturan pribadi, lalu buat kunci aplikasi:

```
copy .env.example .env
php artisan key:generate
```

5. Buat database kosong:
   - Buka `http://localhost/phpmyadmin`.
   - Tab **Databases**, isi nama `halotani_db`, collation `utf8mb4_unicode_ci`, klik **Create**.

6. Buka file `.env`, pastikan isinya:

```
DB_DATABASE=halotani_db
DB_USERNAME=root
DB_PASSWORD=
MAIL_MAILER=log
APP_LOCALE=id
```

7. Buat tabel dan isi data contoh:

```
php artisan migrate:fresh --seed
```

8. Jalankan aplikasi:

```
php artisan serve
```

9. Buka `http://127.0.0.1:8000/petani/login`.

---

## 3. Akun uji coba

| Peran | Email | Kata sandi |
|---|---|---|
| Petani | budi@agritech.test | `sandi= password123`  |
| Admin | admin@agritech.test | `sandi= password123` |

Pendaftar baru lewat `/petani/register` otomatis berperan petani.
Panel admin belum dibuat, jadi akun admin belum punya halaman sendiri.

---

## 4. Setelah git pull

```
composer install
npm install
php artisan migrate
php artisan config:clear
```

Kalau ada migrasi baru dan isi database lokal tidak penting:

```
php artisan migrate:fresh --seed
```

Perintah ini MENGHAPUS semua data di database lokal.

---

## 5. Peta folder

| Lokasi | Isinya |
|---|---|
| `app/Models` | Model: Petani, Keluhan, Laporan, AksesLaporan, TemplatePrompt |
| `database/migrations` | Struktur tabel |
| `database/seeders` | Data contoh |
| `app/Providers/Filament/PetaniPanelProvider.php` | Pengaturan panel petani (login, daftar, profil, warna) |
| `app/Filament/Pages/Auth` | Halaman daftar dan profil kustom |
| `.env.example` | Contoh pengaturan, dibagikan lewat Git |
| `.env` | Pengaturan pribadi, JANGAN di-commit |

Folder tempat Resource, halaman, dan widget Filament disimpan ditentukan oleh
baris `discoverResources`, `discoverPages`, dan `discoverWidgets` di
`PetaniPanelProvider.php`. Perintah `make:filament-...` menaruh file otomatis
di folder yang sama.

---

## 6. Menambah fitur dengan Filament

Contoh perintah, dijalankan di folder proyek:

```
php artisan make:filament-resource Keluhan --generate
php artisan make:filament-page NamaHalaman
php artisan make:filament-widget NamaWidget
```

Tambahkan `--help` di belakang perintah untuk melihat pilihan lainnya.

Mengambil petani yang sedang login:

```php
auth()->user();    // objek Petani
auth()->id();      // id_petani
```

Membuat keluhan milik petani yang login:

```php
auth()->user()->keluhan()->create([ ... ]);
```

Halaman di dalam panel Filament otomatis wajib login. Rute buatan sendiri di
luar panel perlu `->middleware('auth')`.

---

## 7. Aturan kerja Git

1. Jangan bekerja langsung di `main`.

2. Satu fitur satu branch, dengan nama `fitur/nama-fitur`:

```
git checkout main
git pull
git checkout -b fitur/nama-fitur
```

3. Sebelum `composer require` atau perintah pemasangan lain, cek branch:

```
git branch --show-current
```

4. Commit kecil dan jelas. Tambahkan folder satu per satu, jangan `git add .`,
   supaya `.env` dan file yang tidak diinginkan tidak ikut:

```
git status
git add app/Models
git commit -m "Tambah model X"
```

5. Kirim, lalu buat pull request di GitHub dan minta satu anggota meninjau:

```
git push -u origin fitur/nama-fitur
```

6. Jangan mengedit file migrasi lama yang sudah di-merge. Untuk perubahan tabel,
   buat migrasi baru, lalu kabari tim:

```
php artisan make:migration tambah_kolom_x_pada_tabel_y --table=y
```

7. Jangan membagikan `.env`, kunci API, atau kata sandi lewat Git. Untuk
   pengaturan baru (misalnya kunci layanan AI), tambahkan nama kuncinya dengan
   nilai kosong di `.env.example`, lalu kabari tim agar mengisinya di `.env`
   masing-masing.

---

## 8. Catatan untuk tiap peran

**Anggota 1 (keluhan dan AI)** 

- Kunci layanan AI hanya di `.env`. Nama kuncinya ditulis di `.env.example`.
- Kalau memakai antrean (Queue), jalankan pekerjanya di terminal terpisah:
note: disesuaikan saja

```
php artisan queue:work
```

- Kolom tabel `keluhan` dan nilai `status` perlu disepakati bersama sebelum
  kode lain bergantung padanya.

**Tim tampilan (Anggota 3 dan 4)**

- Seluruh tampilan petani berada di panel Filament dengan alamat `/petani`.
- Halaman daftar dan profil sudah ada, tinggal disesuaikan tampilannya.
- Kalau membuat tema kustom (CSS), jalankan `npm run dev` di terminal terpisah.

---

## 9. Masalah yang sering muncul

| Pesan atau gejala | Penyebab | Perbaikan |
|---|---|---|
| `No connection could be made ... 3306` | MySQL belum jalan | Laragon, **Start All** |
| `Unknown database 'halotani_db'` | Database belum dibuat | Buat di phpMyAdmin |
| Perubahan `.env` tidak berpengaruh | Pengaturan tersimpan di cache | `php artisan config:clear` |
| `Class ... not found` | Daftar class belum diperbarui | `composer dump-autoload` |
| Error kolom atau tabel tidak ada | Migrasi belum dijalankan | `php artisan migrate` |
| Login gagal | Kata sandi salah, atau data belum di-seed | Cek `PetaniSeeder.php`, lalu `php artisan migrate:fresh --seed` |
| `Route [login] not defined` | Rute login bawaan Laravel tidak ada | Tambahkan di `routes/web.php`: `Route::redirect('/login', '/petani/login')->name('login');` |
| `Unable to load dynamic library 'intl'` | Windows memblokir file PHP | PowerShell: `Get-ChildItem <folder php> -Recurse \| Unblock-File` |
| `npm` diblokir PowerShell | Kebijakan skrip | `Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned`, atau pakai cmd |

---

## 10. Status fitur

| Fitur | Status |
|---|---|
| Daftar, login, logout, dasbor | Selesai |
| Lihat dan ubah profil | Selesai |
| Lupa kata sandi | Dalam perbaikan. Email ditulis ke `storage/logs/laravel.log`, belum terkirim sungguhan |
| Panel admin, kelola pengguna, kelola template prompt | Belum dikerjakan |