<?php

use Core\App\MicroApp;

require dirname(__DIR__) . '/vendor/autoload.php';
include dirname(__DIR__) . '/app/config/config.php';

// Enabling errors showing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


try {
    $app = new MicroApp();

    $app->GET('/user/{id: \d+}', ['controller' => 'Index', 'action' => 'view']);
    $app->GET('/user', ['controller' => 'Index', 'action' => 'index']);

    $app->handle();

} catch (Exception $exception) {
    echo "<pre>";
    echo $exception->getMessage();
    echo $exception->getTraceAsString();
    echo "</pre>";
}
