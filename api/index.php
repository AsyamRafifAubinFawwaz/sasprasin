<?php

// 1. Hapus paksa cache bawaan dari mesin build Vercel yang sering bikin salah jalur
$cachePath = __DIR__ . '/../bootstrap/cache/';
@unlink($cachePath . 'config.php');
@unlink($cachePath . 'routes.php');
@unlink($cachePath . 'packages.php');
@unlink($cachePath . 'services.php');

// 2. Trik: Paksa Laravel menampilkan ERROR ASLI dalam format teks murni (JSON)
$_SERVER['HTTP_ACCEPT'] = 'application/json';

// 3. Jalankan aplikasi Laravel
require __DIR__ . '/../public/index.php';