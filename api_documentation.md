# 🔌 Lokalify REST API Documentation

Dokumentasi ini menyediakan spesifikasi lengkap mengenai endpoint RESTful API untuk aplikasi **Lokalify**. API ini memfasilitasi komunikasi data antara frontend/mobile app dengan server backend Laravel.

---

## 📌 Base URL

```text
http://localhost:8000/api/v1
```

---

## 🔒 Autentikasi & Header

Sebagian besar endpoint memerlukan autentikasi menggunakan **Bearer Token** (Laravel Sanctum/Passport).

### Header Standard

| Key | Value | Keterangan |
| :--- | :--- | :--- |
| `Content-Type` | `application/json` | Format request data |
| `Accept` | `application/json` | Mengharapkan respons dalam format JSON |
| `Authorization` | `Bearer {token}` | Wajib untuk endpoint terproteksi |

---

## 🔑 1. Auth Endpoints

### 1.1 Register User Baru
* **URL:** `/auth/register`
* **Method:** `POST`
* **Akses:** Publik

#### Request Body
```json
{
  "name": "Despian Ananda",
  "email": "despian@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

#### Response (201 Created)
```json
{
  "success": true,
  "message": "Registrasi berhasil",
  "data": {
    "user": {
      "id": 1,
      "name": "Despian Ananda",
      "email": "despian@example.com",
      "role": "user"
    },
    "token": "1|qX8zL...token_string"
  }
}
```

---

### 1.2 Login System
* **URL:** `/auth/login`
* **Method:** `POST`
* **Akses:** Publik

#### Request Body
```json
{
  "email": "despian@example.com",
  "password": "password123"
}
```

#### Response (200 OK)
```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "user": {
      "id": 1,
      "name": "Despian Ananda",
      "email": "despian@example.com",
      "role": "user"
    },
    "token": "2|aBcD...token_string"
  }
}
```

---

### 1.3 Logout
* **URL:** `/auth/logout`
* **Method:** `POST`
* **Akses:** Protected (Bearer Token)

#### Response (200 OK)
```json
{
  "success": true,
  "message": "Logout berhasil"
}
```

---

## 🏔️ 2. User Endpoints (Wisata)

### 2.1 Mendapatkan Daftar Tempat Wisata
* **URL:** `/wisata`
* **Method:** `GET`
* **Akses:** Publik / Protected
* **Query Parameters (Opsional):**
  * `search` (string): Cari berdasarkan nama destinasi.
  * `category` (string): Filter kategori (misal: *alam*, *kuliner*, *sejarah*).

#### Response (200 OK)
```json
{
  "success": true,
  "message": "Daftar tempat wisata berhasil diambil",
  "data": [
    {
      "id": 101,
      "title": "Kawah Putih Ciwidey",
      "slug": "kawah-putih-ciwidey",
      "category": "Alam",
      "location": "Rancabali, Bandung",
      "price": 30000,
      "image_url": "http://localhost:8000/uploads/kawah-putih.jpg",
      "rating": 4.8,
      "created_at": "2026-03-01T10:00:00.000000Z"
    }
  ]
}
```

---

### 2.2 Mendapatkan Detail Wisata
* **URL:** `/wisata/{id}` atau `/wisata/detail/{slug}`
* **Method:** `GET`
* **Akses:** Publik / Protected

#### Response (200 OK)
```json
{
  "success": true,
  "message": "Detail wisata ditemukan",
  "data": {
    "id": 101,
    "title": "Kawah Putih Ciwidey",
    "description": "Danau kawah vulkanik yang menakjubkan dengan tanah berwarna putih kemerahan...",
    "category": "Alam",
    "location": "Rancabali, Kabupaten Bandung, Jawa Barat",
    "price": 30000,
    "opening_hours": "07:00 - 17:00 WIB",
    "image_url": "http://localhost:8000/uploads/kawah-putih.jpg",
    "rating": 4.8,
    "updated_at": "2026-03-05T08:30:00.000000Z"
  }
}
```

---

## 🛠️ 3. Admin Endpoints (Kelola Wisata / CRUD)

### 3.1 Menambah Data Wisata Baru
* **URL:** `/admin/wisata`
* **Method:** `POST`
* **Akses:** Protected (Role: Admin)

#### Request Body (multipart/form-data)
* `title` (string, required)
* `description` (text, required)
* `category` (string, required)
* `location` (string, required)
* `price` (numeric, required)
* `image` (file: jpg/png, max 2MB)

#### Response (201 Created)
```json
{
  "success": true,
  "message": "Data wisata berhasil ditambahkan",
  "data": {
    "id": 102,
    "title": "Situ Patenggang",
    "category": "Alam",
    "price": 25000,
    "image_url": "http://localhost:8000/uploads/situ-patenggang.jpg"
  }
}
```

---

### 3.2 Mengubah Data Wisata (Update)
* **URL:** `/admin/wisata/{id}`
* **Method:** `PUT` / `POST` (dengan `_method: PUT`)
* **Akses:** Protected (Role: Admin)

#### Request Body
```json
{
  "title": "Situ Patenggang Lakeside",
  "price": 30000
}
```

#### Response (200 OK)
```json
{
  "success": true,
  "message": "Data wisata berhasil diperbarui",
  "data": {
    "id": 102,
    "title": "Situ Patenggang Lakeside",
    "price": 30000
  }
}
```

---

### 3.3 Menghapus Data Wisata (Delete)
* **URL:** `/admin/wisata/{id}`
* **Method:** `DELETE`
* **Akses:** Protected (Role: Admin)

#### Response (200 OK)
```json
{
  "success": true,
  "message": "Data wisata berhasil dihapus"
}
```

---

## ⚠️ Code Standard Response Status

| HTTP Status | Deskripsi |
| :--- | :--- |
| `200 OK` | Request berhasil diproses. |
| `201 Created` | Data/Resource baru berhasil dibuat. |
| `400 Bad Request` | Format parameter request salah/kurang. |
| `401 Unauthorized` | Token tidak valid atau belum terautentikasi. |
| `403 Forbidden` | Akun tidak memiliki hak akses (bukan Admin). |
| `404 Not Found` | Data tempat wisata tidak ditemukan. |
| `422 Unprocessable Entity` | Validasi input gagal (misal: email sudah terpakai). |
| `500 Internal Server Error` | Gangguan pada server. |