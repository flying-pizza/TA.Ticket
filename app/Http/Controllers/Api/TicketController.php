<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function checkTicket(Request $request)
    {
        $qr = $request->input('qr_code');

        $ticket = Ticket::where('qr_code', $qr)->first();

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Tiket Tidak Terdaftar!']);
        }

        if ($ticket->is_checked_in) {
            return response()->json(['status' => 'error', 'message' => 'Tiket Sudah Pernah Dipakai!']);
        }

        $ticket->update(['is_checked_in' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Selamat Datang, ' . $ticket->name,
            'name' => $ticket->name
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string',
            'jumlah_tiket' => 'required|integer|min:1|max:2',
        ]);

        // =======================================================
        // TETEK BENGEK PEMBATASAN KUOTA (BIAR GAK KAYAK PASAR MALEM)
        // =======================================================
    
        $batas_kuota_total = 100; 
    
        $total_terjual = Ticket::sum('jumlah_tiket');
        if (($total_terjual + $request->jumlah_tiket) > $batas_kuota_total) {
            return back()->with('error', 'Maaf banget, kuota tiket sudah habis terjual!');
        }

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
            'kategori' => $request->kategori,
            'jumlah_tiket' => $request->jumlah_tiket,
            'qr_code' => $kode_random,
            'is_checked_in' => false,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'PENDING',
        ]);

        return view('register-tiket', ['kode' => $kode_random]);
    }
}