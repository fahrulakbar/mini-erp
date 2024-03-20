
## Spesifikasi Program
 Merupakan Penerapan dari sistem ERP sederhana yang memiliki beberapa role dan jobdesk masing masing role, antara lain: 

1. Sales:
Bertanggung jawab untuk membuat Sales Order (SO) dan mengubah statusnya menjadi Approved setelah persetujuan.

2. Admin Purchase: 
Membuat Purchase Order (PO) yang terkait dengan Sales Order yang sudah disetujui.
Mengubah status PO menjadi Approved setelah persetujuan.

3. Admin Warehouse
Membuat penerimaan barang berdasarkan Purchase Order yang sudah disetujui.
Menyetujui penerimaan barang untuk mengubah statusnya menjadi Approved.
Bertanggung jawab untuk memperbarui stok barang setelah penerimaan barang disetujui.

## Development Setup

1. Clone repository.
2. Pindah ke branch develop, git checkout develop.
3. Buat database baru dengan nama bebas.
4. Copy .env.example menjadi .env.
5. Konfigurasi koneksi database pada file .env.
6. Run composer update.
7. Buka terminal dan run php artisan key:generate.
8. Run php artisan migrate --seed.
9. npm install && npm update

Setup selesai, run php artisan serve untuk menjalankan aplikasi.
Buka browser dan akses localhost:8000.
Selesai.
