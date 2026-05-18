<?php

use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/register', function () {
    return view('register-tiket');
});

Route::post('/register', function (Request $request) {
    // 1. Validasi biar gak ada nama kosong
    $request->validate(['name' => 'required|min:3']);

    // 2. Bikin kode unik otomatis (Contoh: TITI-XXXX)
    $kodeUnik = 'EVT-' . strtoupper(Str::random(5));

    // 3. Masukin ke database
    Ticket::create([
        'name' => $request->name,
        'qr_code' => $kodeUnik,
        'is_checked_in' => false,
    ]);

    // Cari bagian return di route POST /register tadi, ganti jadi:
    return view('register-tiket', ['kode' => $kodeUnik]);
    })->name('tiket.simpan');

    Route::get('/download-tiket/{kode}', function ($kode) {
    // Cari data tiket di database berdasarkan kode QR
    $ticket = App\Models\Ticket::where('qr_code', $kode)->firstOrFail();

    // Generate QR Code dalam bentuk Base64 (supaya bisa dibaca di dalam PDF)
    $qrcode = base64_encode(QrCode::format('svg')->size(150)->generate($ticket->qr_code));

    // Lempar data ke dalam desain cetak
    $pdf = Pdf::loadView('cetak-tiket', compact('ticket', 'qrcode'));
    
    // Download otomatis dengan nama file tiketnya
    return $pdf->download("Tiket_{$ticket->qr_code}.pdf");
})->name('tiket.download');