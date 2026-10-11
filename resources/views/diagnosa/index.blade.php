@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-success mb-1">🌾 Konsultasi Tanaman AI</h4>
                    <p class="text-muted small mb-4">Masukkan detail kondisi lahan dan masalah tanaman Anda untuk dianalisis oleh Agritech Assistant.</p>

                    <form action="{{ route('diagnosa.proses') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lokasi Lahan / Wilayah</label>
                            <input type="text" name="lokasi_lahan" class="form-control @error('lokasi_lahan') is-invalid @enderror" placeholder="Contoh: Madiun, Jawa Timur" value="{{ old('lokasi_lahan') }}" required>
                            @error('lokasi_lahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Keluhan / Gejala Tanaman</label>
                            <textarea name="keluhan_petani" rows="4" class="form-control @error('keluhan_petani') is-invalid @enderror" placeholder="Contoh: Daun padi menguning dan ada bercak coklat berujung runcing..." required>{{ old('keluhan_petani') }}</textarea>
                            @error('keluhan_petani')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2 fw-semibold rounded-3">
                            🔍 Analisis Masalah Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection