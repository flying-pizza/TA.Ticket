<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Event Terpadu</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-950 text-white min-h-screen flex flex-col justify-center items-center p-6">

    <div class="max-w-4xl w-full text-center mb-10">
        <h1 class="text-4xl font-extrabold text-purple-500 tracking-wider mb-2">TICKETMASTER 2.0</h1>
        <p class="text-slate-400">Silakan pilih event aktif di bawah ini untuk melakukan pendaftaran tiket</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl w-full">
        
        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-lg flex flex-col justify-between hover:border-purple-500 transition duration-300">
            <div>
                <span class="bg-purple-600/20 text-purple-400 text-xs font-bold px-2.5 py-1 rounded-full border border-purple-500/30">K-POP</span>
                <h3 class="text-xl font-bold mt-3 mb-2 text-white">FESTA BTS 2026</h3>
                <p class="text-slate-400 text-sm mb-4">📍 Gelora Bung Karno, Jakarta</p>
            </div>
            <a href="{{ route('tiket.register', 'bts') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-center font-bold py-2 px-4 rounded-lg transition text-white shadow-md shadow-purple-600/20">
                Pilih Event
            </a>
        </div>

        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-lg flex flex-col justify-between hover:border-purple-500 transition duration-300">
            <div>
                <span class="bg-sky-600/20 text-sky-400 text-xs font-bold px-2.5 py-1 rounded-full border border-sky-500/30">K-POP</span>
                <h3 class="text-xl font-bold mt-3 mb-2 text-white">TXT WORLD TOUR</h3>
                <p class="text-slate-400 text-sm mb-4">📍 Grand City, Surabaya</p>
            </div>
            <a href="{{ route('tiket.register', 'txt') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-center font-bold py-2 px-4 rounded-lg transition text-white shadow-md shadow-purple-600/20">
                Pilih Event
            </a>
        </div>

        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-lg flex flex-col justify-between hover:border-purple-500 transition duration-300">
            <div>
                <span class="bg-emerald-600/20 text-emerald-400 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-500/30">LOCAL</span>
                <h3 class="text-xl font-bold mt-3 mb-2 text-white">Pentas Seni Kelas 11</h3>
                <p class="text-slate-400 text-sm mb-4">📍 Aula Utama SMKN</p>
            </div>
            <a href="{{ route('tiket.register', 'pensi') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-center font-bold py-2 px-4 rounded-lg transition text-white shadow-md shadow-purple-600/20">
                Pilih Event
            </a>
        </div>

    </div>

</body>
</html>