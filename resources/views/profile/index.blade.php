@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Utama Profile -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 60px; height: 60px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                            <p class="text-muted small mb-0">{{ $user->email }} • <span class="badge bg-success-subtle text-success">{{ $user->role }}</span></p>
                        </div>
                    </div>

                    <div class="row g-3 border-top pt-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Wilayah Lahan Utama</small>
                            <span class="fw-semibold text-dark">📍 {{ $user->lokasi }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Bergabung Sejak</small>
                            <span class="fw-semibold text-dark">🗓️ {{ $user->joined_at }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Status Integrasi AI -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-success mb-3">⚙️ Status Layanan AI</h6>
                    <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3">
                        <div>
                            <div class="fw-semibold text-dark">OpenRouter Gateway</div>
                            <small class="text-muted">Model Active: {{ config('services.openrouter.model', 'nvidia/nemotron-3.5-lightning:free') }}</small>
                        </div>
                        <span class="badge bg-success px-3 py-2 rounded-pill">Connected</span>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('diagnosa.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                    ← Kembali ke Konsultasi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection