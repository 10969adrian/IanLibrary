=============Tentang Project Ini=============

Ian's Library adalah Sistem Informasi Perpustakaan Berbasis Web yang digunakan untuk mengelola data perpustakaan secara digital. Sistem ini mendukung pengelolaan buku, kategori, pengguna, peminjaman, ulasan buku, dan koleksi favorit.

Project ini dibuat sebagai tugas Mata Kuliah Web Framework Semester 4 yang diampu oleh Bapak Frengklin Matatula, S.Kom., M.M.Si. di STMIK Palangkaraya.

=============Fitur Utama=============

Admin
* Kelola Data Buku
* Kelola Kategori Buku
* Kelola User
* Melihat Data Peminjaman
* Melihat Data Ulasan

Petugas
* Verifikasi Peminjaman
* Pengelolaan Pengembalian Buku
* Monitoring Data Peminjaman

Peminjam
* Melihat Katalog Buku
* Mengajukan Peminjaman Buku
* Memberikan Rating dan Ulasan
* Menambahkan Buku ke Koleksi Favorit
* Melihat Riwayat Peminjaman

=============Instalasi=============

1. Salin folder project ke dalam folder `htdocs`.
2. Jalankan Apache dan MySQL melalui XAMPP.
3. Buat database baru di phpMyAdmin.
4. Import file database `library.sql`.
5. Sesuaikan konfigurasi database pada:
6. application/config/database.php
7. Jalankan aplikasi melalui browser (http://localhost/nama_project)

=============Akun Login=============

* Admin
Username : ianstar
Password : 12345678

* Petugas
Username : MusangKing
Password : wantutri

* Peminjam
Username : 10969adrian
Password : acumalaka || Username : miawmiaw
Password : adriannor || Username : nanonano
Password : sixseven || Username : fufufafa
Password : fafafufu

=============Struktur Database=============

* user
Menyimpan data pengguna sistem

* buku
Menyimpan data buku perpustakaan

* kategori
Menyimpan kategori buku

* peminjaman
Menyimpan data peminjaman dan pengembalian

* ulasanbuku
Menyimpan rating dan ulasan pengguna terhadap buku

* koleksipribadi
Menyimpan daftar buku favorit pengguna

=============Pengembang=============
Nama : Adriannor
NIM : E2457401008
Program Studi : Manajemen Informatika
