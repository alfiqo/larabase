# Larabase

## Fitur Semart Skeleton

- Pengaturan User

- Pengaturan Role

- Pengaturan Permission

- Pengaturan Hak Akses


## Kebutuhan Sistem

- PHP 7.4 atau lebih baru

- MySQL/MariaDB/PostgreSQL sebagai RDBMS

- Composer sebagai Dependencies Management


## Cara Instalasi (Menggunakan Composer)

- Clone repositori dengan `git clone` command:

```
git clone https://github.com/alfiqo/larabase.git larabase
```

atau dengan `composer create-project` command:

- Masuk ke direktori `larabase` dengan perintah `cd larabase`

- Jalankan perintah `composer update --prefer-dist -vvv`

- Jalankan perintah `php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder` untuk seeder default role & permissions
- Jalankan perintah `php artisan serve` untuk menjalankan web server

- Buka browser pada alamat `http://localhost:8000` atau sesuai port yang tampil ketika menjalankan perintah diatas

- Gunakan email `admin@larabase.com` dan password `password` untuk masuk ke aplikasi


## Bug dan Request Fitur

Anda dapat menggunakan `Issues` untuk melaporkan adanya bug, atau menggunakan `Pull requests` untuk request fitur.

## Kontributor

Terima kasih kepada semua [kontributor](https://github.com/alfiqo/larabase/graphs/contributors)
