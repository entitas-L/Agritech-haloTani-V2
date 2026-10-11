<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KiraAIService;

class DiagnosaController extends Controller
{
    public function index()
    {
        return view('diagnosa.index');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'lokasi_lahan' => 'required|string|max:255',
            'keluhan_petani' => 'required|string|min:10',
        ]);

        $hasil = KiraAIService::generateSolusi(
            $request->keluhan_petani,
            $request->lokasi_lahan
        );

        return redirect()->route('diagnosa.result')->with([
            'hasil' => $hasil,
            'lokasi' => $request->lokasi_lahan,
            'keluhan' => $request->keluhan_petani,
        ]);
    }
        public function hasil()
    {
        // Cek apakah ada data session dari proses diagnosa
        if (!session()->has('hasil')) {
            return redirect()->route('diagnosa.index');
        }

        return view('diagnosa.hasil');
    }
}