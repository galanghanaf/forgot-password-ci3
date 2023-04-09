# Forgot Password with Gmail and WhatsApp in CodeIgniter 3

## Setup Database (MariaDB/MySql)

Setup ini berfungsi untuk melakukan scheduler, ketika token masuk ke dalam database, token tersebut hanya dapat bertahan selama 5 menit.

- Import db_forgotpassword.sql
- SHOW PROCESSLIST;
- SET GLOBAL event_scheduler = ON;

## Setup Email (Gmail)

- Pergi ke "Manage your Google Account"
- Masuk ke "Security"
- Aktifkan "2 Step Verification"
- Setelah mengaktifkan 2 Step Verification, pergi ke 2 Step Verification lagi, scrool kebawah, pilih "App Password"
- Pilih Select App "Mail"
- Pilih Select Device "Windows Computer"
- Lalu Generate Password, Copy dan Simpan Passwordnya

```
Password ini akan digunakan pada "application/config/email".
```

## Setup WhatsApp API

- Keluar dari folder sistem
- Git Clone WhatsApp Tutorial API

```
git clone https://github.com/ngekoding/whatsapp-api-tutorial.git
```

- NPM Install

```
npm install
```

- Catatan

```
Bila ingin mengubah portnya masuk ke "apps.js", cari portnya (di line 13) lalu ganti 8080 misalnya.
```

- NPM Run

```
npm run start:dev
```

- Scan Barcode WhatsApp di http://localhost:8080

## Setup WhatsApp Helper in Codeigniter 3

- Composer Install

```
composer install
```
