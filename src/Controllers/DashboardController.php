<?php

namespace Src\Controllers;

use Src\Models\User;

class DashboardController extends Controller
{
    // Método para renderizar a página inicial do dashboard
    public static function index()
    {
        // Verifica se o usuário está autenticado
        if (!self::isAuthenticated()) {
            header('Location: ' . URL . '/login');
            exit();
        }

        // Obter os dados do usuário autenticado
        $user = self::getAuthenticatedUser();

        // Renderiza a página do dashboard com os dados do usuário
        self::layout('dashboard');
        echo self::view('admin/dashboard', ['user' => $user]);
    }

    // Método para verificar se o usuário está autenticado
    private static function isAuthenticated()
    {
        // Verifica se há uma sessão ou cookie de autenticação
        return isset($_SESSION['user_id']) || isset($_COOKIE['user_id']);
    }

    // Método para obter os dados do usuário autenticado
    private static function getAuthenticatedUser()
    {
        $userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'] ?? null;
        return User::find($userId);
    }
}
