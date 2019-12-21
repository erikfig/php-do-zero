<?php

require __DIR__ . '/vendor/autoload.php';

// defino o método http e a url amigável
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

// instancio o Router
$router = new ErikFig\Framework\Router($method, $path);

// registro as rotas
$router->get('/', function () {
    return 'Olá mundo';
});

$router->get('/ola-{nome}', function ($params) {
    return 'Olá ' . $params[1];
});

// faço o router encontrar a rota que o usuário acessou
$result = $router->handler();

// se retornar false, dou um erro 404 de página não encontrada
if (!$result) {
    http_response_code(404);
    echo 'Página não encontrada!';
    die();
}

// imprimo a página atual
echo $result($router->getParams());