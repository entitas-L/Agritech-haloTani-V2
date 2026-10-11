<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6">
        <!-- Form Input -->
        <x-filament::section>
            <form wire:submit="prosesDiagnosa" class="space-y-6">
                {{ $this->form }}

                <div class="flex justify-end pt-4">
     <x-filament::button 
        type="submit" 
        color="success" 
        icon="heroicon-o-sparkles"
        wire:loading.attr="disabled"
        wire:target="prosesDiagnosa"
    >
        <span wire:loading.remove wire:target="prosesDiagnosa">
            Analisis Masalah Sekarang
        </span>
        <span wire:loading wire:target="prosesDiagnosa">
            Sedang Menganalisis dengan AI...
        </span>
    </x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <!-- Hasil Analisis AI -->
    @if($hasilAnalisis)
        <x-filament::section icon="heroicon-o-check-circle" icon-color="success" class="mt-6">
            <x-slot name="heading">
                Hasil Rekomendasi Agritech Assistant
            </x-slot>

            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                {!! \Illuminate\Support\Str::markdown($hasilAnalisis) !!}
            </div>
        </x-filament::section>
    @endif
    </div>
</x-filament-panels::page>