<?php
namespace Src\Controllers;

use Src\Models\User;

class LoginController extends Controller
{
    // Método para renderizar a página de login
    public static function index()
    {
        self::layout('admin');
        echo self::view('admin/login');
    }

    // Método para renderizar a página de registro
    public static function register()
    {
        self::layout('admin');
        echo self::view('admin/register');
    }

    // Método para autenticar o usuário
    public static function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $remember = isset($_POST['remember']);

            // Verificar se o usuário existe
            $user = User::findByUsername($username);
            if (!$user) {
                self::send(['success' => false, 'message' => 'Nome de usuário não existe.'], 404);
                return;
            }

            // Verificar se o usuário está confirmado
            if ($user->confirmed != 1) {
                self::send(['success' => false, 'message' => 'Conta não autorizada.'], 403);
                return;
            }

            // Autenticar usuário
            if (self::authenticate($user, $password)) {
                // Configurar a sessão de "lembrar-me" se marcado
                if ($remember) {
                    setcookie('user_id', $user->id, time() + 86400 * 7, '/'); // 7 dias
                }
                self::send(['success' => true, 'message' => 'Usuário autenticado com sucesso!', 'url' => URL], 200);
            } else {
                self::send(['success' => false, 'message' => 'Nome de usuário ou senha inválidos.'], 403);
            }
        }
    }

    // Método para registrar um novo usuário
    public static function registerUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $terms = isset($_POST['terms']);

            // Verificar se o usuário já existe
            $user = new User();
            if ($user->findByUsername($username)) {
                self::send(['success' => false, 'message' => 'Nome de usuário já está em uso.'], 409);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                self::send(['success' => false, 'message' => 'Endereço de e-mail inválido.'], 400);
                return;
            }

            if (!$terms) {
                self::send(['success' => false, 'message' => 'Você deve aceitar os termos e condições.'], 400);
                return;
            }

            // Criptografar a senha
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Criar um novo usuário
            $user = new User(); // Cria uma instância de User
            $userId = $user->create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $hashedPassword,
                'confirmed' => 0 // Define como 0 por padrão
            ]);

            if ($userId) {
                // Enviar a resposta de sucesso
                self::send(['success' => true, 'message' => 'Registro bem-sucedido.'], 201);
            } else {
                // Enviar resposta de erro se a criação falhar
                self::send(['success' => false, 'message' => 'Erro ao criar o usuário.'], 500);
            }
        }
    }


    // Método de autenticação de usuário
    private static function authenticate($user, $password)
    {
        return password_verify($password, $user->password);
    }
}
