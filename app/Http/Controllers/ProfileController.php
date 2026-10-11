<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Mock data user / ambil dari auth() jika sudah ada auth
        $user = auth()->user() ?? (object)[
            'name' => 'Leo Rhamanata',
            'email' => 'leo@halotani.id',
            'role' => 'Petani / Pengelola Lahan',
            'lokasi' => 'Madiun, Jawa Timur',
            'joined_at' => 'Oktober 2026',
        ];

        return view('profile.index', compact('user'));
    }
}