<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function checkTicket(Request $request)
    {
        // 1. Ambil kode QR dari Python nanti
        $qr = $request->input('qr_code');

        // 2. Cari di database
        $ticket = Ticket::where('qr_code', $qr)->first();

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Tiket Tidak Terdaftar!']);
        }

        if ($ticket->is_checked_in) {
            return response()->json(['status' => 'error', 'message' => 'Tiket Sudah Pernah Dipakai!']);
        }

        // 3. Kalau aman, tandai sudah hadir
        $ticket->update(['is_checked_in' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Selamat Datang, ' . $ticket->name,
            'name' => $ticket->name
        ]);
    }

    public function simpan(Request $request)
    {
        // 1. Validasi inputan dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string',
            'jumlah_tiket' => 'required|integer|min:1|max:2',
        ]);

        // =======================================================
        // TETEK BENGEK PEMBATASAN KUOTA (BIAR GAK KAYAK PASAR MALEM)
        // =======================================================
    
        // Tentukan batas total kuota penonton event kamu di sini (misal: maks 100 tiket)
        $batas_kuota_total = 100; 
    
        // Hitung total tiket yang SUDAH terjual di database saat ini
        $total_terjual = Ticket::sum('jumlah_tiket');

        // Cek apakah kalau ditambah pembelian baru ini bakal melebihi kuota total
        if (($total_terjual + $request->jumlah_tiket) > $batas_kuota_total) {
            return back()->with('error', 'Maaf banget, kuota tiket sudah habis terjual!');
        }

        // Cek apakah nomor WhatsApp ini sudah pernah daftar sebelumnya (Anti-Calo)
        $sudah_pernah_beli = Ticket::where('whatsapp', $request->whatsapp)->exists();
        if ($sudah_pernah_beli) {
            return back()->with('error', 'Nomor WhatsApp ini sudah digunakan untuk membeli tiket!');
        }

        // =======================================================
        // JIKA LOLOS PENGECEKAN, BARU GENERATE KODE & SIMPAN
        // =======================================================
        $kode_random = 'EVT-' . strtoupper(Str::random(5));

        Ticket::create([
            'name' => $request->name,
            'whatsapp' => $request->whatsapp,
            'jumlah_tiket' => $request->jumlah_tiket,
            'qr_code' => $kode_random,
            // tambahkan kolom lain milikmu jika ada...
        ]);

        // Kembalikan ke halaman dengan membawa kode tiket biar QR-nya muncul
        return view('register-tiket', ['kode' => $kode_random]);
    }
}