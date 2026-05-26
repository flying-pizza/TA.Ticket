<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = [
        'name',
        'whatsapp',
        'kategori',
        'jumlah_tiket',
        'qr_code',
        'is_checked_in',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    protected static function booted()
    {
        static::creating(function ($ticket) {
            // Kalau pas bikin tiket di Filament qr_code nya kosong, otomatis dibuatin random
            if (empty($ticket->qr_code)) {
                $ticket->qr_code = 'EVT-' . strtoupper(Str::random(5));
            }
        });
    }
}
