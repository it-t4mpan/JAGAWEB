![WhatsApp Image 2024-11-14 at 15 19 24](https://github.com/user-attachments/assets/0b70768c-0046-48f4-a42f-810b8146f125)

# JAGAWEB - Jaringan Analisis Government Active Websites 
# Monitoring Web Defacement (.go.id) from FCKNG 7UDOL

## Deskripsi
Script PHP ini dirancang untuk memantau potensi defacement pada situs .go.id yang berhubungan dengan konten judi online. Dengan menggunakan Google API Custom Search, skrip ini melakukan pencarian secara otomatis dengan kata kunci "site: *.go.id slot", dan menampilkan hasil pencarian dalam rentang waktu satu jam terakhir. Apabila ada hasil baru, skrip akan mengirim notifikasi ke Telegram dengan pesan yang mencakup judul dan tautan ke situs terkait.

## Fitur Utama
1. **Dorking Otomatis**: Melakukan pencarian otomatis di Google berdasarkan keyword khusus.
2. **Notifikasi Telegram**: Mengirimkan notifikasi ke bot Telegram dengan pesan "Web defacement Judi Online Terbaru", timestamp, dan daftar situs hasil pencarian.
3. **Penjadwalan dengan Cron Job**: Script dapat dijalankan secara berkala melalui cron job untuk pemantauan otomatis.
4. **UI Responsif**: Menggunakan Tailwind CSS untuk tampilan yang menarik, responsif, dan mudah digunakan.

## Struktur dan Alur Kerja
1. **Pencarian Google API**: Skrip menggunakan Google Custom Search API untuk melakukan pencarian dengan filter satu jam terakhir.
2. **Notifikasi Telegram**: Jika ada hasil baru, skrip akan membuat pesan berisi daftar situs yang ditemukan dan mengirimkannya ke bot Telegram.
3. **User Interface**: Halaman utama menampilkan daftar hasil pencarian terbaru dalam UI yang dibuat dengan Tailwind CSS.
4. **Footer Copyleft**: Terdapat footer di bagian bawah halaman yang mencantumkan copyleft serta penghargaan untuk NKRI.

## Pengaturan Awal
1. **Google API Key**: Diperlukan kunci API Google untuk mengakses Custom Search Engine. Dapat diperoleh melalui akun Google Cloud.
2. **Custom Search Engine ID**: Dibuat di Google CSE untuk memfilter domain .go.id.
3. **Bot Token Telegram**: Diperlukan token bot dan ID chat untuk mengirim pesan notifikasi.

## Langkah Instalasi dan Penggunaan
1. Buat proyek baru di Google Cloud dan aktifkan Custom Search API. Ambil `Google API Key` dan `Custom Search Engine ID` untuk domain .go.id.
2. Buat bot Telegram untuk menerima notifikasi, lalu ambil `Bot Token` dan `Chat ID`.
3. Tempatkan semua konfigurasi pada skrip PHP (`$googleApiKey`, `$customSearchEngineId`, `$telegramToken`, `$telegramChatId`).

## Penjadwalan Otomatis
Gunakan cron job untuk menjalankan skrip secara berkala. Contoh penjadwalan per jam:
```bash
0 * * * * php /path/to/your_script.php
```

## Persyaratan
- PHP 7.4 atau lebih baru.
- Akses internet untuk API Google dan Telegram.
- Ekstensi PHP untuk cURL atau `file_get_contents`.

## Kredit
&copy; 2024 xsan-lahci - Dibuat dengan ❤️ untuk NKRI
