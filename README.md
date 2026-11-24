# Laundry Rey — Sistem Manajemen Laundry & Rekap Transaksi Modern

Aplikasi web operasional laundry modern berbasis Laravel 11, Tailwind CSS, dan Alpine.js yang dirancang dengan antarmuka presisi, responsif, dan mudah digunakan untuk kebutuhan kasir maupun pemilik bisnis (*single-surface operations*).

---

## Fitur Utama

- **Rekap Transaksi Cepat & Interaktif:**
  - Manajemen order (tambah transaksi, ubah status cucian langsung di tabel, dan hapus transaksi).
  - Ringkasan metrik real-time: Total Transaksi, Pesanan Diproses, Pesanan Selesai, dan Total Pendapatan.
  - Grafik mingguan interaktif dan diagram donat proporsi status pesanan (Selesai, Proses, Batal).
  - Filter status pesanan dan pencarian instan tanpa reload halaman.
- **Cetak Struk Transaksi:**
  - Format nota/struk thermal dan invoice resmi berstandar siap cetak (`window.print()`).
- **Data Pelanggan (Customer Directory):**
  - Pencatatan seluruh pelanggan unik beserta nomor telepon, total frekuensi order, total akumulasi belanja, dan status terakhir.
  - Tombol pintas hubungi pelanggan via WhatsApp (`https://wa.me/62...`).
- **Master Data Layanan:**
  - Katalog 8 jenis layanan cucian lengkap dengan ikon/foto SVG, kategori durasi, tarif/harga per kilogram, dan estimasi pengerjaan.
- **Sistem Autentikasi & Otorisasi Berbasis Peran:**
  - **Pendaftaran Akun Petugas Baru:** Formulir registrasi modern vertikal untuk mendaftarkan akun baru dengan pemilihan hak akses (Kasir atau Administrator) serta validasi data dan kata sandi.
  - **Administrator:** Akses penuh ke seluruh fitur dan Master Data Layanan.
  - **Kasir:** Fokus pada operasional transaksi harian, pencatatan order, dan rekap data pelanggan.
  - Akses cepat demo login 1-klik (*Masuk sebagai Kasir* & *Masuk sebagai Administrator*).
- **Desain UI/UX Responsif & Modern:**
  - Tata letak responsif penuh di berbagai ukuran layar (Desktop, Tablet, Mobile).
  - Navigasi tanpa menu hamburger tersembunyi; akses tab langsung di mobile.
  - Logo mesin cuci interaktif dengan animasi putaran tabung.

---

## Kebutuhan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB

---

## Panduan Instalasi

1. **Clone repositori:**
   ```bash
   git clone https://github.com/Ray4dye/LaundryRey.git
   cd LaundryRey
   ```

2. **Instal dependensi PHP & JavaScript:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Sesuaikan kredensial basis data pada berkas `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laundryrey
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Migrasi dan Seeder Basis Data:**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Build Aset Frontend:**
   ```bash
   npm run build
   ```

6. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Buka peramban pada alamat `http://127.0.0.1:8000`.

---

## Akun Demo

| Peran | Email | Kata Sandi |
|---|---|---|
| **Kasir** | `kasir@gmail.com` | `kasir123` |
| **Administrator** | `admin@gmail.com` | `admin123` |

---

## Pengujian Otomatis

Jalankan pengujian unit dan fitur:
```bash
php artisan test
```

---

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).
