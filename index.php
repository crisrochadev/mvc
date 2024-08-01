<?php


use Dotenv\Dotenv;

require __DIR__ . "/vendor/autoload.php";

// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require __DIR__ . '/config/constants.php';
require __DIR__ . '/config/index.php';