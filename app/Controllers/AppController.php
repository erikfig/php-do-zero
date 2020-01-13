<?php

namespace App\Controllers;

use Twig\Environment;

abstract class AppController
{
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}
