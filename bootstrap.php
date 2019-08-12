<?php

// Carrego o arquivo do Composer que faz o autoload
require __DIR__ . '/vendor/autoload.php';

// Sem eu precisar fazer mais nada, TODOS os
// arquivos de rota serão incluídos automaticamente
$router = new ErikFig\Framework\Router;
