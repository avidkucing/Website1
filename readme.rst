###################
Aplikasi Logistik Hisamitsu
###################

Aplikasi logistik pencatatan bahan baku dan produk.

**************************
Changelog and New Features
**************************

Masih dalam tahap pengembangan alur bahan baku.


************
Requirements
************

- Web server (Apache)

- MySQL database

- PHP 5.4

************
Installation
************

1. Clone git pada directory server yang akan digunakan pada web server. Ubah nama folder menjadi 'manufaktur'.

2. Buat database "manufaktur" pada database MYSQL dan import file manufaktur.sql.

3. Konfigurasi pengaturan database pada application/config/database.php untuk pengaturan hostname, username, password, dan nama database.

4. Konfigurasi url base pada application/config/config.php untuk pengaturan base_url.


************
Operation
************

1. Jalankan mysql dan web server.

2. Buka web browser pada komputer klien.

3. Buka halaman : {web base URL}/manufaktur

4. Login menggunakan akses akun di bawah.


************
Account access
************

Jenis akun -> username :

- Administrator 			-> admin
- Kepala Gudang 	-> mr_head_gudang
- Gudang 					-> mr_gudang
- Quality-Control 			-> mr_qc
- Kepala Quality-Control 	-> mr_head_qc
- Produksi 					-> mr_produksi_b1
- Produksi 2 		-> mr_produksi_b2

All password : yoyomam@

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.
