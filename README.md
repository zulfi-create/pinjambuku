# LibraCI - Sistem Peminjaman Buku

> Proyek Mata Kuliah Pemrograman Web  
> Framework: CodeIgniter 4 | Database: MySQL

---

## Identitas Mahasiswa

| Field     | Isi               |
|-----------|-------------------|
| Nama      | MARZAN ZULFIKAR TUNJUNG  |
| NIM       | 230101084         |
| Prodi     | TEKNIK INFORMATIKA   |

---

## Tema Kasus

**Sistem Peminjaman Buku (Perpustakaan Digital)**

Sistem Peminjaman Buku (Perpustakaan Digital) adalah aplikasi yang dibuat untuk membantu proses peminjaman buku menjadi lebih cepat dan praktis. Sistem ini menggantikan cara manual (tulis tangan) menjadi sistem komputer, sehingga lebih efisien dan rapi.

Dengan aplikasi ini, pengguna bisa mencari dan meminjam buku dengan mudah tanpa harus melalui proses yang rumit.

Sistem ini memiliki dua jenis pengguna:

**Administrator (Pustakawan):** Bertugas mengelola sistem, seperti menambah atau mengedit data buku, mengelola anggota, serta memantau proses peminjaman dan pengembalian.
**User (Anggota):** Bisa melihat daftar buku yang tersedia dan melakukan peminjaman secara langsung melalui sistem.

---

## Struktur Database

Terdapat **3 tabel** dalam database `db_peminjaman_buku`:

### 1. `users`
Menyimpan data akun pengguna (admin & user).

| Kolom      | Tipe               | Keterangan                     |
|------------|--------------------|--------------------------------|
| id         | INT (PK, AI)       | Primary Key                    |
| username   | VARCHAR(100)       | Username unik untuk login      |
| name       | VARCHAR(150)       | Nama lengkap pengguna          |
| password   | VARCHAR(255)       | Password (bcrypt hash)         |
| role       | ENUM(admin, user)  | Peran pengguna                 |
| created_at | DATETIME           | Waktu dibuat                   |
| updated_at | DATETIME           | Waktu diperbarui               |

### 2. `buku`
Menyimpan data koleksi buku perpustakaan.

| Kolom       | Tipe                        | Keterangan                |
|-------------|-----------------------------|---------------------------|
| id          | INT (PK, AI)                | Primary Key               |
| title       | VARCHAR(200)                | Judul buku                |
| author      | VARCHAR(150)                | Nama penulis              |
| isbn        | VARCHAR(50)                 | Nomor ISBN (opsional)     |
| description | TEXT                        | Deskripsi buku            |
| stock       | INT                         | Jumlah stok buku          |
| status      | ENUM(available,unavailable) | Status ketersediaan       |
| created_at  | DATETIME                    | Waktu dibuat              |
| updated_at  | DATETIME                    | Waktu diperbarui          |

### 3. `pinjam`
Mencatat transaksi peminjaman buku.

| Kolom       | Tipe                    | Keterangan                         |
|-------------|-------------------------|------------------------------------|
| id          | INT (PK, AI)            | Primary Key                        |
| user_id     | INT (FK → users.id)     | Relasi ke tabel users              |
| book_id     | INT (FK → buku.id)      | Relasi ke tabel buku               |
| borrow_date | DATE                    | Tanggal mulai meminjam             |
| due_date    | DATE                    | Batas tanggal pengembalian         |
| return_date | DATE                    | Tanggal dikembalikan (nullable)    |
| status      | ENUM(borrowed,returned) | Status peminjaman                  |
| created_at  | DATETIME                | Waktu dibuat                       |
| updated_at  | DATETIME                | Waktu diperbarui                   |

---

## Fitur Aplikasi

### Autentikasi
- ✅ Halaman Login dengan validasi
- ✅ Password dienkripsi dengan **bcrypt** (`PASSWORD_BCRYPT`)
- ✅ Sistem Session CI4
- ✅ Redirect otomatis berdasarkan role (admin/user)
- ✅ Proteksi halaman dengan **Filter** (AuthFilter & AdminFilter)
- ✅ Logout dan hapus session

### Admin
- ✅ Dashboard statistik (total buku, user, peminjaman aktif)
- ✅ **CRUD Buku**: Tambah, lihat, edit, hapus buku
- ✅ **CRUD Pengguna**: Tambah, lihat, edit, hapus user
- ✅ **Kelola Peminjaman**: Lihat semua peminjaman & konfirmasi pengembalian
- ✅ Indikator buku terlambat dikembalikan

### User (Peminjam)
- ✅ Dashboard dengan daftar buku yang tersedia
- ✅ Tombol **Pinjam Sekarang** dengan masa pinjam 7 hari
- ✅ Riwayat peminjaman pribadi

---

## Cara Instalasi & Menjalankan

### Prasyarat
- PHP >= 8.1
- Composer
- XAMPP (MySQL/MariaDB)

### Langkah-langkah

**1. Clone / Salin proyek**
```bash
# Salin folder peminjaman_buku_ci4 ke htdocs XAMPP atau gunakan spark serve
```

**2. Install dependensi CI4**
```bash
composer install
```

**3. Konfigurasi environment**
```bash
# Rename atau copy file env menjadi .env
cp env .env
```
Edit `.env`:
```
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = db_peminjaman_buku
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

**4. Buat database**

**Opsi A** - Import file SQL:
```sql
-- Import file database.sql via phpMyAdmin
```

**Opsi B** - Gunakan migration CI4:
```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

**5. Jalankan server**
```bash
php spark serve
```

Akses di browser: `http://localhost:8080`

---

## Akun Login Default

| Role  | Username | Password  |
|-------|----------|-----------|
| Admin | admin    | admin123  |
| User  | budi     | user123   |
| User  | siti     | user123   |

---

## Struktur Folder

```
peminjaman_buku_ci4/
├── app/
│   ├── Config/
│   │   ├── Filters.php       ← Registrasi filter
│   │   └── Routes.php        ← Definisi rute
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── BookController.php
│   │   │   └── UserController.php
│   │   ├── AuthController.php
│   │   └── UserDashboardController.php
│   ├── Database/
│   │   ├── Migrations/       ← Skema tabel
│   │   └── Seeds/            ← Data awal
│   ├── Filters/
│   │   ├── AuthFilter.php    ← Cek login
│   │   └── AdminFilter.php   ← Cek role admin
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── BookModel.php
│   │   └── BorrowingModel.php
│   └── Views/
│       ├── layouts/main.php  ← Layout utama
│       ├── auth/login.php
│       ├── admin/
│       ├── books/
│       ├── users/
│       └── user/
├── database.sql              ← Export database
├── env                       ← Konfigurasi environment
└── README.md
```
