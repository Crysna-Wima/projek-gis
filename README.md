# Laravel 10 - Sistem Informasi Manajemen Rantai Pasok

## Pendahuluan

Selamat datang di base template SIMRP (Sistem Informasi Manajemen Rantai Pasok) versi Laravel 10. Template ini dirancang untuk memenuhi kebutuhan manajemen rantai pasokan menggunakan Laravel 10. Pastikan sistem Anda memenuhi persyaratan minimum seperti PHP 8.1 dan PostgreSQL.

## Spesifikasi

- PHP minimum 8.1, atau lihat dokumentasi Laravel [requirements](https://laravel.com/docs/10.x/releases#support-policy)
- PostgreSQL

## Instalasi

1. Buka terminal atau command prompt dan navigasi ke folder ini.
2. Jalankan perintah-perintah berikut:

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

3. buat database terlebih dahulu
4. setting .env nya

```bash
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=postgres
DB_PASSWORD=your_database
```

```bash
php artisan migrate --seed
```

Jika Anda telah menginstal composer:

```bash
git pull origin main
```

```bash
composer update
```

### Commit, Pull, and Push

Sebelum membuat perubahan, buat branch baru di GitHub:

```bash
git branch -M your_branch
```

Lakukan commit pada perubahan Anda:

```bash
git commit -m "your_commit"
```

Selalu dapatkan perubahan terbaru dari main:

```bash
git pull origin main
```

Kemudian dorong perubahan ke branch Anda:

```bash
git push -u origin your_branch
```

### Copyright

...