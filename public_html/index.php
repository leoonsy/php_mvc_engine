<?php

declare(strict_types=1);

mb_internal_encoding("UTF-8");

ini_set('display_errors', (string) 1);
ini_set('display_startup_errors', (string) 1);
ini_set('error_reporting', (string) E_ALL);

require_once 'vendor/autoload.php';

use app\core\Router;
use YaLinqo\Enumerable;

/**
 * Возвращает путь до файла по классу пространства имен
 *
 * @param sring $class
 * @param string $ext
 * @return string
 */
function classToFile($class, $ext = '.php') {
    $temp = explode('\\', $class);
    $temp[count($temp) - 1] = lcfirst($temp[count($temp) - 1]); //делаем название файла с маленькой буквы
    $path = implode('/', $temp).$ext;
    return $path;
}

spl_autoload_register(function ($class) {
    $path = classToFile($class);
    if (file_exists($path)) {
        require $path;
    }
});

$router = new Router;
$router->run();
