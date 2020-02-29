# Pembelajaran PHP - Sistem Informasi Cuaca BMKG

Pembelajaran PHP-MySQL sederhana dengan membuat sistem informasi cuaca BMKG (khusus Provinsi Jawa Tengah)

## Instalasi
1. Buat MySQL database: `cuaca`
2. Import file `cuaca-kecamatan.sql`

## XML API
1. Daftar Kabupaten/Kota dalam 1 Provinsi: http://localhost/cuaca/api.php?provinsi=Jawa%20Tengah
2. Daftar Kecamatan dalam 1 Kabupaten/Kota disertai cuaca terkini: http://localhost/cuaca/api.php?kabkota=Kab.%20Sragen
3. Data prakiraan cuaca dalam 1 kecamatan: http://localhost/cuaca/api.php?id=5010293

## Fitur
1. Tampilan informasi cuaca dengan menggunakan peta interaktif
2. API data cuaca dengan format XML
