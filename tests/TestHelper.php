<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Config\Adapter\Ini as ConfigIni;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("ROOT_PATH", __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// требуется для phalcon/incubator
include __DIR__ . "/../vendor/autoload.php";

$config = new ConfigIni('../app/config/config.ini');

// Используем автозагрузчик приложений для автозагрузки классов.
// Автозагрузка зависимостей, найденных в composer.
$loader = new Loader();

$loader->registerDirs(
    [
        ROOT_PATH,
        $config->phalcon->servicesDir,
        $config->phalcon->modelsDir
    ]
);

$loader->register();

$di = new FactoryDefault();

Di::reset();

// здесь можно добавить любые необходимые сервисы в контейнер зависимостей

Di::setDefault($di);