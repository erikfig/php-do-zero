<?php

namespace ErikFig\Framework\Users;

use Twig\Environment;
use ErikFig\Framework\Router;

class Register
{
    public static function handle(Environment $twig, Router $router)
    {
        // Aqui registro a rota
        $loader = $twig->getLoader();
        $loader->addPath(__DIR__ . '/../templates');

        // Aqui registro as rotas
        $router->get('/users', 'ErikFig\Framework\Users\Controllers\UsersController::index');
    }
}
