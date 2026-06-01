<?php

// 1. Buat folder sementara paksa di RAM Vercel agar Laravel bisa bernapas
$compiledPath = '/tmp/storage/framework/views';
if (!is_dir($compiledPath)) {
    mkdir($compiledPath, 0777, true);
}

// 2. Paksa Laravel pakai folder sementara tersebut dan matikan fitur nulis file
putenv("VIEW_COMPILED_PATH=$compiledPath");
$_ENV['VIEW_COMPILED_PATH'] = $compiledPath;
$_SERVER['VIEW_COMPILED_PATH'] = $compiledPath;

// Hindari nulis session, log, dan cache ke folder asli yang di-lock Vercel
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');
putenv('CACHE_STORE=array');

// 3. Paksa Laravel menampilkan Error Asli (menyalakan Debug paksa)
putenv('APP_DEBUG=true');
$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';

// 4. Jalankan aplikasi seperti biasa
require __DIR__ . '/../public/index.php';