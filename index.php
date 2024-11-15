<?php
// Konfigurasi API
$googleApiKey = 'YOUR_GOOGLE_API';
$customSearchEngineId = 'YOUR_CUSTOM_SEARCH_ENGINE';
$telegramToken = 'YOUR_TELEGRAM_TOKEN';
$telegramChatId = 'YOUR_TELEGRAM_CHATID';

// Fungsi untuk melakukan pencarian di Google dengan Google API
function searchGoogle($keyword, $googleApiKey, $customSearchEngineId) {
    $url = "https://www.googleapis.com/customsearch/v1?q=" . urlencode($keyword) . 
           "&cx=" . $customSearchEngineId . "&key=" . $googleApiKey . "&dateRestrict=d1";

    $response = file_get_contents($url);
    return json_decode($response, true);
}

// Fungsi untuk mengirim notifikasi ke Telegram
function sendTelegramNotification($telegramToken, $telegramChatId, $message) {
    $url = "https://api.telegram.org/bot$telegramToken/sendMessage";
    $data = [
        'chat_id' => $telegramChatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}

// Pencarian dengan dorking
$keyword = "site:*.go.id slot";
$results = searchGoogle($keyword, $googleApiKey, $customSearchEngineId);

// Membuat pesan untuk notifikasi
$message = "🤬 Web Defacement Judi Online Terbaru 🤬\n";
$message .= "Timestamp: " . date("Y-m-d H:i:s") . "\n";
if (!empty($results['items'])) {
    foreach ($results['items'] as $item) {
        $message .= "\n☠ <a href='" . $item['link'] . "'>" . $item['title'] . "</a>";
    }
} else {
    $message .= "Tidak ada hasil ditemukan.";
}

// Kirim notifikasi ke Telegram
sendTelegramNotification($telegramToken, $telegramChatId, $message);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dorking Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto p-5">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-5">JAGAWEB - Jaringan Analisis Government Active Websites / Monitoring Web Defacement (.go.id)</h2>
            <p class="text-gray-700 text-lg mb-4">Pencarian situs pemerintah yang terkena defacement judi online dalam 1 jam terakhir.</p>
            
            <div class="bg-gray-200 p-5 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Hasil Pencarian</h3>
                <?php if (!empty($results['items'])): ?>
                    <ul class="list-disc pl-5">
                        <?php foreach ($results['items'] as $item): ?>
                            <li>
                                <a href="<?= $item['link'] ?>" class="text-blue-500 hover:underline" target="_blank"><?= htmlspecialchars($item['title']) ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-red-500">Tidak ada hasil ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Footer Copyleft -->
    <footer class="text-center py-4 mt-8 text-gray-500">
        &copy; 2024 xsan-lahci - Made with ❤️ for NKRI
    </footer>
</body>
</html>
