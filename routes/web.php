<?php

use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// 1. Halaman Depan: Pilihan Banyak Event
Route::get('/', function () {
    return view('welcome'); // Kita pakai file welcome.blade.php bawaan laravel aja biar gampang
});

// 2. Halaman Form Pendaftaran (setelah pilih event)
Route::get('/register/{event}', function ($event) {
    // Kita ganti nama event-nya biar rapi pas ditampilin di form
    $nama_event = match($event) {
        'bts' => 'FESTA BTS 2026 - Jakarta',
        'txt' => "TXT World Tour 'ACT: PROMISE' - Surabaya",
        'pensi' => 'Pentas Seni Kelas 11 SMKN',
        default => 'Event Tidak Diketahui'
    };

    return view('register-tiket', ['nama_event' => $nama_event]);
})->name('tiket.register');

// 3. Route buat proses simpan data dari form pendaftaran
Route::post('/tiket-simpan', [App\Http\Controllers\Api\TicketController::class, 'simpan'])->name('tiket.simpan');

Route::get('/register', function () {
    return redirect('/');
});

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