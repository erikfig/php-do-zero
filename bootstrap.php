<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/database.php';
$twig = require(__DIR__ . '/renderer.php');

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

$router = new ErikFig\Framework\Router($method, $path);

$router->get('/', function () {
    return 'Olá mundo';
});

ErikFig\Framework\Users\Register::handle($twig, $router);

// faço o router encontrar a rota que o usuário acessou
$result = $router->handler();

if (!$result) {
    http_response_code(404);
    echo 'Página não encontrada!';
    die();
}

// pego os dados da entidade
$data = $result->getData();

// rodo os middlewares before
foreach ($data['before'] as $before) {
    // rodo o middleware
    if (!$before($router->getParams())) {
        // se retornar false eu paro a execução do código
        die();
    }
}

// rodo a ação principal
if ($data['action'] instanceof Closure) {
    echo $data['action']($router->getParams());
} elseif (is_string($data['action'])) {
    $data['action'] = explode('::', $data['action']);

    $controller = new $data['action'][0]($twig);
    $action = $data['action'][1];

    echo $controller->$action($router->getParams());
}

// rodo os middlewares after
foreach ($data['after'] as $after) {
    // rodo o middleware
    if (!$after($router->getParams())) {
        // se retornar false eu paro a execução do código
        die();
    }
}
