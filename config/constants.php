<?php

$environment = $_ENV['ENVIRONMENT'];

// Definir a constante ASSETS com base no ambiente
if ($environment === 'development') {
    define("ASSETS", "http://" . $_SERVER['HTTP_HOST'] . "/vidara/public/assets");
    define("URL", "http://" . $_SERVER['HTTP_HOST'] . "/vidara");
} else {
    define("ASSETS", "http://" . $_SERVER['HTTP_HOST'] . "/public/assets");
    define("URL", "http://" . $_SERVER['HTTP_HOST'] . "");
}