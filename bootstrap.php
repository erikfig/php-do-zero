<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/database.php';
$twig = require(__DIR__ . '/renderer.php');

// defino o método http e a url amigável
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

// instancio o Router
$router = new ErikFig\Framework\Router($method, $path);

// registro as rotas
$router->get('/', function () {
    return 'Olá mundo';
});

ErikFig\Framework\Users\Register::handle($twig, $router);

// faço o router encontrar a rota que o usuário acessou
$result = $router->handler();

// se retornar false, dou um erro 404 de página não encontrada
if (!$result) {
    http_response_code(404);
    echo 'Página não encontrada!';
    die();
}

// verifico se é uma função anônima
if ($result instanceof Closure) {
    // imprimo a página atual
    echo $result($router->getParams());

// se não for uma função anônima e for uma string
} elseif (is_string($result)) {
    // eu quebro a string nos dois-pontos, dois::pontos
    // transformando em array
    $result = explode('::', $result);

    // instancio o controller
    $controller = new $result[0]($twig);
    // guardo o método a ser executado (em um controller ele se chama action)
    $action = $result[1];

    // finalmente executo o método da classe
    echo $controller->$action($router->getParams());
}