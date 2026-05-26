# 🎟️ Sistem Verifikasi Tiket Event (Tugas Akhir)

Aplikasi berbasis web yang dirancang khusus untuk memenuhi tugas mata pelajaran **Konsentrasi Keahlian (Konsli)**. Sistem ini berfungsi untuk mengelola pendaftaran tiket event secara dinamis, manajemen invoice pembayaran oleh admin, serta validasi kehadiran tamu menggunakan sistem check-in yang terintegrasi.

---

## 🚀 Fitur Utama Sistem

* **Pendaftaran Tiket Mandiri:** Halaman registrasi user yang bersih untuk memilih kategori tiket (seperti VIP incl. Dinner atau CAT) serta memilih metode pembayaran secara langsung.
* **Manajemen Panel Admin (Filament v3):** * **Modul Pembayaran:** Memantau uang masuk, mendaftar nama pengirim, dan mengubah status transaksi dari `PENDING` menjadi `SUCCESS` setelah diverifikasi.
  * **Modul Tiket:** Otomatis menghasilkan data tiket tamu beserta **QR Code Cadangan** unik bagi pendaftar yang status pembayarannya sudah lunas.
* **Sistem Antarmuka Kustom:** Sidebar yang bersih dan fokus hanya pada menu operasional inti (`Tickets` & `Pembayaran`) dengan menyembunyikan default dashboard bawaan demi efisiensi kerja admin.

---

## 🛠️ Spesifikasi Teknologi (Tech Stack)

* **Framework Inti:** Laravel 13 (PHP Web Framework)
* **Panel Admin:** Filament v3 (TALL Stack - Tailwind, Alpine.js, Laravel Livewire)
* **Database:** MySQL / MariaDB (via Laragon)
* **Kustomisasi Tema:** Brand color bertema ungu gelap (*Dark Mode & Purple Accent*) yang disesuaikan dengan....

---

## 📂 Struktur Repositori Inti

* `app/Filament/Resources/` — Berisi konfigurasi utama tampilan halaman Admin (`TicketResource.php` dan `PaymentResource.php`).
* `app/Providers/Filament/` — Pengaturan hak akses, tema warna ungu, rute menu, dan manajemen sidebar (`AdminPanelProvider.php`).
* `routes/web.php` — Berisi jalur rute pendaftaran sisi user dan integrasi sistem.

---

*Dibuat dengan penuh perjuangan, drama eror, dan secangkir kopi demi kelancaran Tugas Akhir (TA).* 💜