<?php

namespace Core;

// Контроль ошибок
error_reporting(E_ALL);
ini_set('display_errors', 'on');

// Отправка заголовков
header('Content-Type: text/html;charset=utf-8');

// Стартуем сессию
session_start();

// Определяем основные константы
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ACCESS', true);
define('URI', $_SERVER['REQUEST_URI']);

require_once ROOT . '/project/config/autoload.php';
require_once ROOT . '/project/config/config.php';
require_once ROOT . '/project/config/debug.php';
require_once ROOT . '/project/config/libraries.php';


$routes = require ROOT . '/project/config/routes.php';
$track = (new Router)->getTrack($routes, URI);
$page  = (new Dispatcher)->getPage($track);

echo (new View)->render($page);
echo "ddd";
