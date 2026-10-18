<?php
// Remplace .htaccess pour le serveur PHP intégré
// Lancer avec : php -S localhost:8000 router.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// Si c'est un fichier réel (CSS, image, JS), on le sert directement
if ($path !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';