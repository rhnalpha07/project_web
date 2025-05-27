# Project Web - Toko Buku

Website toko buku berbasis Laravel.

## Fitur
- Katalog buku
- Manajemen stok
- Transaksi pembelian/penjualan (tambahkan fitur lain sesuai kebutuhanmu)

## Stack Teknologi
- PHP (Laravel)
- MySQL/MariaDB
- HTML, CSS, JavaScript

## Cara Install & Jalankan di Lokal

1. **Clone repository:**
   ```bash
   git clone https://github.com/rhnalpha07/project_web.git
   cd project_web
   ```

2. **Install dependensi via Composer:**
   ```bash
   composer install
   ```

3. **Copy file environment:**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Atur konfigurasi database** di file `.env` sesuai dengan setting MySQL kamu.

6. **Migrasi database:**
   ```bash
   php artisan migrate
   ```

7. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```

## Cara Deploy (Umum Laravel)

1. **Upload semua file ke server** (kecuali folder `vendor`, bisa di-install ulang di server).
2. **Jalankan perintah berikut di server:**
   ```bash
   composer install
   ```
3. **Copy/atur file `.env`** dan konfigurasi database produksi.
4. **Generate ulang key aplikasi (jika perlu):**
   ```bash
   php artisan key:generate
   ```
5. **Migrasi database di server:**
   ```bash
   php artisan migrate --force
   ```
6. **Set permission folder storage dan bootstrap/cache:**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```
7. **Arahkan document root web server ke folder `public`.**
8. **(Opsional) Jalankan perintah optimize:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Catatan
- Deploy di shared hosting biasanya folder Laravel diletakkan di luar `public_html`, dan isi folder `public` dipindah ke `public_html`.
- Untuk VPS/cloud, pastikan PHP, Composer, dan ekstensi yang dibutuhkan sudah terinstall.

## Lisensi
[MIT](LICENSE)
