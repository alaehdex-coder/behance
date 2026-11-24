<?php
// Lists every image in /photos so the site can load them automatically.
// Also writes photos.json, which the deployed (static, no-PHP) site on Vercel reads.
header('Content-Type: application/json');
$dir = __DIR__ . '/photos';
$files = is_dir($dir) ? glob($dir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) : [];
natsort($files);
$list = array_values(array_map(fn($f) => 'photos/' . rawurlencode(basename($f)), $files));
$json = json_encode($list, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@file_put_contents(__DIR__ . '/photos.json', $json . "\n");
echo $json;
