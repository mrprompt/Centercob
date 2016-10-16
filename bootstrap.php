<?php
header('Content-type: text/plain');

/* @var $loader \Composer\Autoload\ClassLoader */
$loader = require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

return $loader;