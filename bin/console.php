<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new \Console\App\Commands\PrintCustomerCommand());
$app->add(new \Console\App\Commands\AddCustomerCommand());
$app->add(new \Console\App\Commands\SearchCustomerCommand());

$app->run();