<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tiket Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-96">
        <h2 class="text-2xl font-bold mb-2 text-center text-purple-400">Pendaftaran Tiket</h2>
        <p class="text-sm text-gray-400 text-center mb-6 font-semibold">{{ $nama_event ?? 'FESTA BTS 2026' }}</p>
        
        @if(session('success'))
            <div class="bg-green-500 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($kode))
    <div class="mt-6 p-4 bg-white rounded-lg flex flex-col items-center">
        <p class="text-black font-bold mb-2 text-center">Simpan QR Code Ini:</p>
        
        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($kode) !!}
        
        <p class="text-black mt-2 font-mono text-sm">{{ $kode }}</p>
        <a href="{{ route('tiket.download', $kode) }}" class="mt-4 inline-block bg-orange-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition text-sm">
        Download Tiket (PDF)
        </a>
    </div>
        <a href="{{ url('/') }}" class="block mt-6 text-center text-gray-400 hover:text-white text-sm underline">
            Kembali ke Menu Utama
        </a>
@else
        <form action="{{ route('tiket.simpan') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm mb-2 text-gray-300">Nama Lengkap</label>
                <input type="text" name="name" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-purple-500 outline-none text-white" required placeholder="Masukkan nama lengkap">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-2 text-gray-300">Nomor WhatsApp</label>
                <input type="number" name="whatsapp" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-purple-500 outline-none text-white" required placeholder="Contoh: 08123456789">
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-2 text-gray-300">Kategori Tiket</label>
                <select name="kategori" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-purple-500 outline-none text-white" required>
                    <option value="VIP (Free Merchandise)">👑 VIP (incl dinner)</option>
                    <option value="CAT 1">🎟️ CAT 1</option>
                    <option value="CAT 2">🎟️ CAT 2</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm mb-2 text-gray-300">Jumlah Tiket (Maks. 2 Tiket)</label>
                <select name="jumlah_tiket" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-purple-500 outline-none text-white" required>
                    <option value="1">1 Tiket</option>
                    <option value="2">2 Tiket</option>
                </select>
            </div>

            <div class="mb-6">
    <label class="block text-sm mb-2 text-gray-300">Metode Pembayaran</label>
    <select name="metode_pembayaran" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-purple-500 outline-none text-white" required>
        <option value="DANA">📱 DANA (0822-2895-3100)</option>
        <option value="GOPAY">📱 GoPay (0822-2895-3100)</option>
        <option value="SHOPEEPAY">📱 ShopeePay (0822-2895-3100)</option>
        <option value="BANK TRANSFER">🏦 Transfer Bank BCA (777-777-777)</option>
    </select>
</div>

            <button type="submit" class="w-full bg-orange-600 hover:bg-purple-700 p-2 rounded font-bold transition text-white">
                Dapatkan Tiket
            </button>
        </form>
    @endif

    </div>
</body>
</html>