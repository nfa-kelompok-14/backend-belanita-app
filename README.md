# 🌸 Belanita

## Tentang Proyek

**Belanita** adalah aplikasi yang didedikasikan untuk memperjuangkan hak-hak perempuan dan keadilan yang cepat. Terinspirasi dari kata *"bela wanita"*, misi kami adalah memastikan setiap suara perempuan didengar serta hak-haknya dihormati dan ditegakkan.

Melalui mekanisme pelaporan yang responsif dan informasi yang edukatif, Belanita berkomitmen menciptakan dunia yang lebih aman dan adil bagi semua perempuan.

---

## 🚀 Fitur Utama

- 📢 Endpoint pelaporan kekerasan/pelecehan
- 📄 Informasi dan artikel edukatif
- 🧑‍💼 Autentikasi dan otorisasi pengguna (admin & user)
- 💬 Komentar, tanggapan, dan notifikasi (opsional)
- 📊 Statistik laporan (untuk admin dashboard)

---

## ⚙️ Instalasi & Setup Lokal

### 1. Clone Repository
```bash
git clone https://github.com/nfa-kelompok-14/backend-belanita-app.git
cd backend-belanita-app
```

### 2. Install Dependency
```bash
composer install
```

### 3. Salin File Environment
```bash
cp .env.example .env
```

### 4. Generate Key dan Konfigurasi
```bash
php artisan key:generate
```

### 5. Konfigurasi Database
Edit file .env:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=belanita_api
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan Migrasi dan Seeder
```bash
php artisan migrate --seed
```

### 7. Jalankan Server Lokal
```bash
php artisan serve
```

API biasanya akan berjalan di: http://127.0.0.1:8000
