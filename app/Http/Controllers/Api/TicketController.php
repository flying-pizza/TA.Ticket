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
}