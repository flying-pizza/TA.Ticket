import requests
import win32print

def cetak_struk(nama_tamu, kode_tiket):
    # Ambil nama printer default yang lagi aktif di Windows kamu
    nama_printer = win32print.GetDefaultPrinter()
    
    try:
        # Mulai proses cetak ke printer thermal
        hPrinter = win32print.OpenPrinter(nama_printer)
        try:
            hJob = win32print.StartDocPrinter(hPrinter, 1, ("Struk Masuk", None, "RAW"))
            try:
                win32print.StartPagePrinter(hPrinter)
                
                # Isi teks struk kamu (gunakan \n untuk baris baru)
                isi_struk = f"\n=========================\n"
                isi_struk += f"    FESTA BTS 2026       \n"
                isi_struk += f"=========================\n\n"
                isi_struk += f" Nama : {nama_tamu}\n"
                isi_struk += f" Kode : {kode_tiket}\n\n"
                isi_struk += f" STATUS: BERHASIL MASUK  \n"
                isi_struk += f"=========================\n"
                isi_struk += f"\n\n\n\n" # Kasih jarak kertas kosong biar bisa disobek
                
                # Kirim data ke printer
                win32print.WritePrinter(hPrinter, isi_struk.encode('utf-8'))
            finally:
                win32print.EndPagePrinter(hPrinter)
        finally:
            win32print.EndDocPrinter(hPrinter)
    finally:
        win32print.ClosePrinter(hPrinter)

def verifikasi_tiket():
    print("--- FESTA BTS 2026 ---")
    url = "http://127.0.0.1:8000/api/check-ticket"
    
    while True:
        kode_qr = input("\nSilakan Scan QR Code (atau ketik 'exit' untuk berhenti): ")
        
        if kode_qr.lower() == 'exit':
            break
            
        payload = {'qr_code': kode_qr}
        
        try:
            response = requests.post(url, json=payload)
            data = response.json()
            
            if data['status'] == 'success':
                print(f"✅ YEYYYYYYY BERHASIL: {data['message']}")
                
                # AMBIL NAMA DARI RESPON LARAVEL DAN JALANKAN FUNGSI PRINT!
                nama_tamu = data.get('nama', 'Pengunjung') # Pastikan API Laravel kamu ngirim data 'nama' ya
                cetak_struk(nama_tamu, kode_qr)
                
            else:
                print(f"❌ Yakin udah bener?: {data['message']}")
        except Exception as e:
            print(f"⚠️ Error: ADMIN NGELINDUR - {e}")

if __name__ == "__main__":
    verifikasi_tiket()