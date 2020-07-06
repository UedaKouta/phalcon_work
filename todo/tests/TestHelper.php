<?php

use Phalcon\DI;
use Phalcon\DI\FactoryDefault;

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__);
define('PATH_LIBRARY', __DIR__ . '/../app/library/');
define('PATH_SERVICES', __DIR__ . '/../app/services/');
define('PATH_RESOURCES', __DIR__ . '/../app/resources/');

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// phalcon/incubator のために必要
include __DIR__ . "/../vendor/autoload.php";

// アプリケーションのオートローダを使用してクラスをオートロードする
// composerの依存関係をオートロードする
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    array(
        ROOT_PATH
    )
);

$loader->register();

$di = new FactoryDefault();
DI::reset();

// 必要なサービスをDIに登録する

DI::setDefault($di);