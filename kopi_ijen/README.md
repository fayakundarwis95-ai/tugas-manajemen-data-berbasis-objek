# ☕ Kopi Ijen — Sistem Manajemen Produk
## Pemrograman Berbasis Objek — Praktikum M11

---

## Struktur Direktori

```
kopi_ijen/
├── config/
│   └── Database.php            # Koneksi database
├── controllers/
│   └── ProdukController.php    # Controller produk
├── models/
│   └── Produk.php              # Model CRUD dengan prepared statements
├── views/
│   ├── header.php              # Layout & CSS global (dark coffee theme)
│   ├── footer.php
│   ├── list.php                # Katalog produk
│   ├── tambah.php              # Form tambah produk
│   └── edit.php                # Form edit produk
├── index.php                   # Entry point
├── database.sql                # Script setup database
└── README.md
```

---

## Langkah Koneksi Database via Command Prompt (Laragon)

### Prasyarat
- **Laragon** sudah terinstal dan dijalankan
- **Apache** & **MySQL/MariaDB** aktif (tombol hijau di panel Laragon)

---

### Langkah 1 — Buka Command Prompt

Buka **Command Prompt** (CMD) Windows.
Atau klik kanan ikon Laragon di system tray → **Terminal**.

---

### Langkah 2 — Masuk ke direktori MySQL Laragon

```cmd
cd C:\laragon\bin\mysql\mysql-8.0-winx64\bin
```

> **Catatan:** Sesuaikan nama folder versi MySQL.
> Cek folder yang tersedia di: `C:\laragon\bin\mysql\`

---

### Langkah 3 — Login ke MySQL

```cmd
mysql -u root -p
```

Tekan **Enter** saat diminta password
*(password default Laragon: kosong — langsung tekan Enter)*

Jika berhasil masuk, tampil:
```
Welcome to the MySQL monitor.
mysql>
```

---

### Langkah 4 — Import Database (Cara Tercepat)

Keluar dulu dari MySQL (`EXIT;`), lalu jalankan di CMD:

```cmd
mysql -u root -p < "C:\laragon\www\kopi_ijen\database.sql"
```

**Atau** jalankan manual dari dalam prompt MySQL:

```sql
CREATE DATABASE IF NOT EXISTS kopi_ijen
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE kopi_ijen;

CREATE TABLE IF NOT EXISTS produk (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    kode       VARCHAR(20)   NOT NULL UNIQUE,
    nama       VARCHAR(150)  NOT NULL,
    jenis      VARCHAR(50)   NOT NULL,
    asal_desa  VARCHAR(150)  NOT NULL,
    harga      DECIMAL(12,2) NOT NULL DEFAULT 0,
    stok       INT           NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

### Langkah 5 — Verifikasi

```sql
SHOW DATABASES;
USE kopi_ijen;
SHOW TABLES;
SELECT * FROM produk;
EXIT;
```

---

### Langkah 6 — Salin Proyek ke Laragon

Salin folder `kopi_ijen` ke:
```
C:\laragon\www\kopi_ijen\
```

---

### Langkah 7 — Buka di Browser

Pastikan Apache & MySQL aktif, lalu akses:
```
http://localhost/kopi_ijen/
```

---

## Konfigurasi Database

`config/Database.php`:
```php
private string $host = "localhost";
private string $user = "root";
private string $pass = "";          // kosong = default Laragon
private string $db   = "kopi_ijen";
```

---

## Fitur Aplikasi

| Fitur | Keterangan |
|---|---|
| Katalog Produk | Tabel lengkap semua produk kopi |
| Tambah Produk | Form dengan validasi server-side |
| Edit Produk | Perbarui data produk yang ada |
| Hapus Produk | Hapus dengan konfirmasi |
| Indikator Stok | Hijau (cukup) / Kuning (menipis) / Merah (habis) |
| Format Rupiah | Harga otomatis diformat ke Rupiah |

## Keamanan

- **Prepared Statements** — bebas SQL Injection
- **htmlspecialchars()** — bebas XSS
- Validasi numerik server-side untuk harga & stok
- Charset `utf8mb4` untuk dukungan karakter penuh
