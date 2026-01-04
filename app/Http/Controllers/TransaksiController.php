<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pesanan')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pesanans = Pesanan::all();
        return view('transaksi.create', compact('pesanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_TRANSAKSI' => 'required|string|size:8|unique:transaksi,ID_TRANSAKSI',
            'ID_PESANAN' => 'required|exists:pesanan,ID_PESANAN',
            'STATUS' => 'required|string|max:20',
        ]);

        $pesanan = Pesanan::findOrFail($request->ID_PESANAN);
        $subTotalSatuan = $pesanan->satuan()->sum('SUB_TOTAL');
        $subTotalLayanan = $pesanan->layanan()->sum('SUB_TOTAL');
        $totalBiaya = $subTotalSatuan + $subTotalLayanan;

        $transaksi = Transaksi::create([
            'ID_TRANSAKSI' => $request->ID_TRANSAKSI,
            'ID_PESANAN' => $request->ID_PESANAN,
            'TOTAL_BIAYA' => $totalBiaya,
            'STATUS' => $request->STATUS,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pesanans = Pesanan::all();
        return view('transaksi.edit', compact('transaksi', 'pesanans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_PESANAN' => 'required|exists:pesanan,ID_PESANAN',
            'STATUS' => 'required|string|max:20',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $pesanan = Pesanan::findOrFail($request->ID_PESANAN);
        $subTotalSatuan = $pesanan->pesananSatuan()->sum('sub_total');
        $subTotalLayanan = $pesanan->pesananLayanan()->sum('sub_total');
        $totalBiaya = $subTotalSatuan + $subTotalLayanan;

        $transaksi->update([
            'ID_PESANAN' => $request->ID_PESANAN,
            'TOTAL_BIAYA' => $totalBiaya,
            'STATUS' => $request->STATUS,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
