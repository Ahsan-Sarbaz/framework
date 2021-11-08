<?php

use Jin\Controllers\SiteController;
use Jin\Core\Application;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$app->get('/', [SiteController::class, 'index']);

$app->run();

?>