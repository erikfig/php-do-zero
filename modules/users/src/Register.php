<?php

namespace ErikFig\Framework\Users;

use Twig\Environment;
use ErikFig\Framework\Router;

class Register
{
    public static function handle(Environment $twig, Router $router)
    {
        $loader = $twig->getLoader();
        $loader->addPath(__DIR__ . '/../templates');

        $router->get('/users', 'ErikFig\Framework\Users\Controllers\UsersController::index');
    }
}
