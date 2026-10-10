<x-filament-panels::page.simple>
    <x-slot name="heading">
        <div style="text-align: center;">
            <!-- Tulisan Agritech Assistant (h1) sudah dihapus -->
            <p style="font-size: 1.125rem; font-weight: bold; color: #111827; margin-top: 0.25rem;">Portal Khusus Petani & Pengelola</p>
            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.5rem;">© 2026 Agritech Assistant • Politeknik Negeri Madiun</p>
        </div>
    </x-slot>

    <!-- Kasih flex column biar tombolnya terdorong melar -->
    <form wire:submit="authenticate" style="display: flex; flex-direction: column; gap: 1.25rem; margin-top: 1rem;">
        {{ $this->form }}

        <!-- Pakai x-filament::button dan paksa width: 100% -->
        <x-filament::button type="submit" size="lg" style="width: 100%; justify-content: center;">
            Masuk ke Portal
        </x-filament::button>
    </form>

    <div style="text-align: center; margin-margin-top: 1.5rem; font-size: 0.875rem;">
        <span style="color: #4b5563;">Belum memiliki akun Petani? </span>
        
        <!-- CSS murni khusus untuk link daftar biar bisa ganti warna pas di-hover -->
        <style>
            .link-daftar { 
                color: #1f2937; 
                font-weight: bold; 
                text-decoration: none; 
                transition: color 0.2s ease-in-out; 
            }
            .link-daftar:hover { 
                color: #16a34a; /* Warna hijau terang pas kursor masuk */
            }
        </style>
        
        <a href="/petani/register" class="link-daftar">
            Daftar sekarang
        </a>
    </div>
</x-filament-panels::page.simple>