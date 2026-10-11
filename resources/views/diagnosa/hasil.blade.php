@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <!-- Header Ringkasan Input -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-light">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                            📍 {{ session('lokasi') }}
                        </span>
                        <small class="text-muted">{{ now()->translatedFormat('d F Y, H:i') }} WIB</small>
                    </div>
                    <h6 class="fw-bold mb-1">Keluhan Tanaman:</h6>
                    <p class="text-secondary mb-0">"{{ session('keluhan') }}"</p>
                </div>
            </div>

            <!-- Card Hasil Analisis AI -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                            🤖
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Rekomendasi Agritech Assistant</h5>
                            <small class="text-muted">Powered by OpenRouter AI</small>
                        </div>
                    </div>

                    <!-- Elemen penampung hasil markdown -->
                    <div id="ai-content" class="lh-lg text-dark"></div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2">
                <a href="{{ route('diagnosa.index') }}" class="btn btn-outline-success py-2 px-4 rounded-3 fw-semibold">
                    🔄 Konsultasi Ulang
                </a>
                <button onclick="window.print()" class="btn btn-light py-2 px-4 rounded-3 fw-semibold border">
                    🖨️ Cetak Hasil
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Render Markdown AI -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rawMarkdown = @json(session('hasil'));
        document.getElementById('ai-content').innerHTML = marked.parse(rawMarkdown);
    });
</script>
@endsection