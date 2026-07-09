<div align="center">
  <h1>⚙️ Mini Kanban Board - Back-End (API)</h1>
  <p>RESTful API berbasis Laravel 11 untuk mendukung aplikasi Mini Kanban Board (Tes Teknis Magang - Web Developer).</p>
</div>

---

## 🔗 Repository Terkait
Proyek ini memisahkan arsitektur *Front-End* dan *Back-End* (Decoupled). Ini adalah repositori untuk sisi **Back-End (Server & API)**.
* 🖥️ **Front-End Repository:** [github.com/arielreza/reza-kanban-frontend](https://github.com/arielreza/reza-kanban-frontend)

---

## 🧑‍💻 Detail Peserta
* **Nama Peserta:** Ariel Reza
* **Posisi:** Web Developer

---

## 🛠️ Teknologi yang Digunakan
* **Framework Utama:** Laravel 11
* **Bahasa Pemrograman:** PHP 8.2+
* **Database:** MySQL
* **Autentikasi API:** Laravel Sanctum (Bearer Token)
* **Konfigurasi CORS:** Mendukung komunikasi *cross-origin* dari React (localhost:5173).

---

## 🚀 Panduan Instalasi (Menjalankan API Secara Lokal)

Ikuti langkah-langkah di bawah ini untuk menjalankan server API secara lokal menggunakan **Laragon**, **XAMPP**, atau utilitas server lokal lainnya:

1. **Clone Repository:**
   ```bash
   git clone https://github.com/arielreza/reza-kanban-backend.git
   cd reza-kanban-backend
   ```

2. **Instal Dependensi PHP (Composer):**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment (.env):**
   * Salin file konfigurasi contoh:
     ```bash
     cp .env.example .env
     ```
   * Buka file `.env` yang baru dibuat.
   * Atur kredensial *Database* agar terhubung dengan MySQL lokal Anda (sesuaikan dengan Laragon/XAMPP):
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=reza_kanban_backend
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Buat Database dan Jalankan Migrasi:**
   * Buka phpMyAdmin, HeidiSQL, atau terminal MySQL, lalu buat database kosong dengan nama `reza_kanban_backend`.
   * Setelah database terbuat, jalankan migrasi tabel beserta *seeder* (dummy data) dengan perintah:
     ```bash
     php artisan migrate:fresh --seed
     ```
     *(Perintah ini akan membuat tabel `users`, tabel `tasks`, dan tabel `personal_access_tokens` milik Sanctum, sekaligus mengisinya dengan 6 kartu tugas default).*

6. **Jalankan Server:**
   ```bash
   php artisan serve
   ```
   *Server API akan berjalan di alamat `http://localhost:8000`. Endpoint sudah siap dikonsumsi oleh aplikasi Front-End!*

---

## 📡 Daftar Endpoint API (Route List)

Seluruh permintaan ke endpoint `/api/tasks/*` wajib menyertakan **Bearer Token** pada *header Authorization* yang didapat dari respons saat login.

| Metode | Endpoint | Deskripsi (Tujuan) | Autentikasi |
|---|---|---|---|
| `POST` | `/api/login` | Memeriksa kredensial, menghasilkan Bearer Token Sanctum. | *Public* |
| `POST` | `/api/logout` | Mencabut/Menghapus token yang sedang aktif. | **Wajib** |
| `GET` | `/api/tasks` | Mengambil semua tugas milik user yang sedang login. | **Wajib** |
| `POST` | `/api/tasks` | Membuat tugas baru (Judul wajib diisi). | **Wajib** |
| `PUT` | `/api/tasks/{task}` | Memperbarui seluruh data tugas (dari Modal Edit). | **Wajib** |
| `PATCH` | `/api/tasks/{task}/status` | Hanya memperbarui status kolom (digunakan pada fitur *Drag and Drop*). | **Wajib** |
| `DELETE` | `/api/tasks/{task}` | Menghapus tugas dari database secara permanen. | **Wajib** |

---

## 🔒 Keamanan (Data Isolation)
API ini menggunakan *Eloquent ORM* yang diatur sedemikian rupa sehingga:
- Pengguna A tidak akan bisa melihat `tasks` milik Pengguna B (*Data Isolation* berdasar `user_id`).
- Jika sebuah *request* CRUD mencoba mengakses atau menghapus *task id* yang bukan milik *user_id* yang login, server akan otomatis merespons dengan kode `403 Unauthorized`.
