<?php

use Src\Controllers\Controller;

// Rotas
require __DIR__ . "/routes.php";

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Separar a query string da URI
$parsedUrl = parse_url($uri);
$uriPath = $parsedUrl['path'] ?? '';

// Se estiver em desenvolvimento, ajuste a URI
if ($environment === 'development') {
    $uriPath = str_replace('/vidara', '', $uriPath);
}

$routeFound = false;

if (isset($routes[$method])) {
    foreach ($routes[$method] as $route => $handler) {
        // Corrigir padrão para não incluir query string
        $pattern = "@^" . preg_replace('/{([^}]+)}/', '(?P<$1>[^/]+)', $route) . "$@D";

        if (preg_match($pattern, $uriPath, $matches)) {
            $routeFound = true;
            // Extraindo apenas os parâmetros da URL, se necessário
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

            // Capturar parâmetros do corpo da requisição (se houver)
            if ($method === 'POST' || $method === 'PUT' || $method === 'PATCH') {
                $bodyParams = json_decode(file_get_contents('php://input'), true);
                if (is_array($bodyParams)) {
                    // Use apenas os parâmetros do corpo da requisição se houver
                    $params = array_merge($params, $bodyParams);
                }
            }

            // Passar parâmetros vazios para o manipulador
            if (is_callable($handler)) {
                if (is_array($handler)) {
                    // Se o manipulador é um array (classe e método), use a chamada correta
                    [$class, $method] = $handler;

                    // Passar parâmetros para o método do controlador
                    $reflection = new ReflectionMethod($class, $method);

                    // Verifique se o método é estático
                    if ($reflection->isStatic()) {
                        // Chame o método estático sem passar parâmetros
                        $reflection->invoke(null);
                    } else {
                        // Instancie a classe e chame o método não estático sem passar parâmetros
                        $instance = new $class();
                        $reflection->invoke($instance);
                    }
                } else {
                    // Se o manipulador é uma função anônima ou método de classe estática
                    call_user_func($handler);
                }
            }
            break;
        }
    }
}

if (!$routeFound) {
    echo Controller::error();
}
