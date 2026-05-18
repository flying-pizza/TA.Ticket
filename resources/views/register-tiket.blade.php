<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tiket Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-orange-500">Pendaftaran Tiket</h2>
        
        @if(session('success'))
            <div class="bg-green-500 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($kode))
    <div class="mt-6 p-4 bg-white rounded-lg flex flex-col items-center">
        <p class="text-black font-bold mb-2 text-center">Simpan QR Code Ini:</p>
        
        {!! QrCode::size(200)->generate($kode) !!}
        
        <p class="text-black mt-2 font-mono text-sm">{{ $kode }}</p>
        <a href="{{ route('tiket.download', $kode) }}" class="mt-4 inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition text-sm">
        📥 Download Tiket (PDF)
        </a>
    </div>
    <a href="/register" class="block mt-6 text-center text-gray-400 hover:text-white text-sm underline">
            Kembali ke Menu Utama
        </a>
@else
        <form action="{{ route('tiket.simpan') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:border-orange-500 outline-none" required>
            </div>
            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 p-2 rounded font-bold transition">
                Dapatkan Tiket
            </button>
        </form>
@endif

    </div>
</body>
</html>