<?php

namespace App\Filament\Pages;
use Filament\Pages\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use App\Models\Keluhan;
use App\Services\KiraAIService;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KonsultasiAi extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationLabel = 'Konsultasi AI';
    protected string $view = 'filament.pages.konsultasi-ai';

    public function getTitle(): string
    {
        return 'Konsultasi Tanaman AI';
    }

    public ?array $data = [];
    public ?string $hasilAnalisis = null;
    public bool $isProcessing = false;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form($form)
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('lokasi_lahan')
                    ->label('Lokasi Lahan / Wilayah')
                    ->placeholder('Contoh: Madiun, Jawa Timur')
                    ->required(),

                \Filament\Forms\Components\Textarea::make('keluhan_petani')
                    ->label('Keluhan / Gejala Tanaman')
                    ->placeholder('Contoh: Daun padi menguning...')
                    ->rows(4)
                    ->required(),
            ])
            ->statePath('data');
    }


    public function prosesDiagnosa(): void
    {
        $formData = $this->form->getState();

        // 1. Panggil OpenRouter AI
         $this->hasilAnalisis = KiraAIService::generateSolusi(
            $formData['keluhan_petani'],
            $formData['lokasi_lahan']
        );

        // 2. Format Teks
        $teksKeluhan = "Lokasi: {$formData['lokasi_lahan']}\nKeluhan: {$formData['keluhan_petani']}";
        $petaniId = Auth::id() ?? \App\Models\Petani::first()?->id_petani;

        // 3. Simpan Ke Database
        $keluhan = new Keluhan();
        $keluhan->id_keluhan     = (string) Str::uuid();
        $keluhan->id_petani      = $petaniId;
        $keluhan->teks_keluhan   = $teksKeluhan;
        $keluhan->tanggal        = now()->toDateString();
        $keluhan->status         = 'selesai';
        $keluhan->hasil_analisis = $this->hasilAnalisis;
        $keluhan->save();

        // 4. Notifikasi Sukses
        Notification::make()
            ->title('Diagnosa Berhasil Disimpan!')
            ->success()
            ->send();
    }
}