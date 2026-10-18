<?php
require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'routes/web.php';

App\Routes\Route::dispatch();