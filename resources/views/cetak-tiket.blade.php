<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; background-color: #f3f4f6; padding: 20px; }
        .ticket-card { background: white; border: 2px dashed #301934; border-radius: 10px; width: 350px; margin: 0 auto; padding: 20px; text-align: center; }
        .event-title { font-size: 20px; font-weight: bold; color: #301934; margin-bottom: 5px; }
        .event-subtitle { font-size: 12px; color: #6b7280; margin-bottom: 20px; }
        .user-name { font-size: 18px; font-weight: bold; color: #1f2937; margin-top: 15px; }
        .ticket-code { font-family: monospace; font-size: 14px; color: #4b5563; margin-top: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="ticket-card">
        <div class="event-title">BTS FESTA TICKET</div>
        <div class="event-subtitle">Konsli Tugas Akhir Titi Cantik</div>
        
        <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">

        <div class="user-name">{{ $ticket->name }}</div>
        <div class="ticket-code">{{ $ticket->qr_code }}</div>
        
        <div style="font-size: 10px; color: #9ca3af; margin-top: 10px; border-top: 1px solid #e5e7eb; padding-top: 10px;">
            Bawa tiket ini (Digital/Cetak senyamanmu jangan rempong) ke Gate Masuk
        </div>
    </div>

</body>
</html>