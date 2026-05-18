import requests

def verifikasi_tiket():
    print("--- FESTA BTS 2026 ---")
    url = "http://127.0.0.1:8000/api/check-ticket"
    
    while True:
        # Input ini nanti otomatis terisi pas kamu pakai scanner fisik
        kode_qr = input("\nSilakan Scan QR Code (atau ketik 'exit' untuk berhenti): ")
        
        if kode_qr.lower() == 'exit':
            break
            
        payload = {'qr_code': kode_qr}
        
        try:
            response = requests.post(url, json=payload)
            data = response.json()
            
            if data['status'] == 'success':
                print(f"✅ YEYYYYYYY BERHASIL: {data['message']}")
                # Di sini tempat naruh kode buat nge-print struk nanti
            else:
                print(f"❌ GAGAL: {data['message']}")
                
        except Exception as e:
            print(f"⚠️ Error: ADMIN NGELINDUR")

if __name__ == "__main__":
    verifikasi_tiket()