<?php

use Src\Controllers\HomeController;
use Src\Controllers\LoginController;
use Src\Controllers\DashboardController;

$routes = [
    "GET" => [
        "/" => [HomeController::class, 'index'],
        "/get-start" => [HomeController::class, 'getStart'],
        "/login" => [LoginController::class, 'index'],
        "/register" => [LoginController::class, 'register'],
        "/dashboard" => [DashboardController::class, 'index'],
        // Adicione mais rotas do dashboard conforme necessário
    ],
    "POST" => [
        "/auth" => [LoginController::class, 'auth'],
        "/register" => [LoginController::class, 'registerUser'],
        // Adicione mais rotas do dashboard conforme necessário
    ]
];
