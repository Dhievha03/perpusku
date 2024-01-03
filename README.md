<p align="center"><a href="https://jelajah-nusantara.my.id/" target="_blank"><img src="https://jelajah-nusantara.my.id/logo/logo-no-background.png" width="400"></a></p>

## Tentang Jelajah Nusantara

Teman setia petualangan Anda di berbagai destinasi menakjubkan di Indonesia! Kami lebih dari sekadar aplikasi, kami adalah sahabat perjalanan yang membimbing Anda menemukan keindahan alam, kekayaan budaya, dan pengalaman tak terlupakan di seluruh Nusantara. Kami hadir untuk memastikan setiap langkah perjalanan Anda diberkati dengan keunikan dan keindahan sejarah yang hanya dapat ditemukan di Indonesia. Temukan keajaiban-keajaiban sejarah yang memikat, dari candi kuno hingga peninggalan kolonial, dan rasakan pesona Indonesia yang kaya akan warisan budaya.

## Fitur

### User
- Login dan Register
- Ubah Profil
- CRUD Wisata
- Simpan Wisata
- Logout

### Admin
- Login
- Kelola Data User
- Kelola Data Provinsi
- Kelola Data Wisata
- Approval Wisata
- Logout

## Requirement

- PHP >= 7.3
- Composer >= 2

## Panduan Menginstall Aplikasi

### 1. Clone Repository
```
git clone https://github.com/Dhievha03/jelajah-nusantara.git
```

### 2. Copy Environment Configuration
```
cp .env.example .env
```

### 3. Install Dependensi
```
composer install
```

### 4. Generate Application Key
```
php artisan key:generate
```

### 5. Buat Database

### 6. Update .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 7. Jalankan Migration
```
php artisan migrate
```

### 8. Jalankan db:seed
```
php artisan db:seed
```
credential admin secara default adalah :
- email : admin@jelajah.com
- password : 12345678

### 9. Buat Symbolic Link
```
php artisan storage:link
```

### 10. Jalankan Aplikasi
```
php artisan serve
```
