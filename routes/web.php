<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect(Filament::getLoginUrl());
})->name('login');

// Public dashboard that mirrors the original static index.html but with live data
Route::get('/public-dashboard', function () {
    $total = \App\Models\Pesanan::count();
    $proses = \App\Models\Pesanan::where('STATUS', 'Proses')->count();
    $selesai = \App\Models\Pesanan::where('STATUS', 'Selesai')->count();
    $totalPendapatan = \App\Models\Pesanan::sum('TOTAL_BIAYA');

    $pesanans = \App\Models\Pesanan::with('pelanggan')
        ->orderByDesc('TANGGAL_MASUK')
        ->limit(6)
        ->get();

    return view('index', compact('total','proses','selesai','totalPendapatan','pesanans'));
});

Route::get('/', function () {
    return redirect()->route('login');
}); 