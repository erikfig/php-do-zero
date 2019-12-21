<?php

namespace ErikFig\Framework;

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testVerificaSeEncontraRota()
    {
        // instancio o Router informando o método HTTP e a url digitada
        $router = new Router('GET', '/ola-mundo');

        // registro minha primeira rota esta rota só retorna um true
        // este valor é só para os nossos testes
        $router->add('GET', '/ola-mundo', function () {
            return true;
        });

        // executados o método que encontra a rota atual
        // a rota atual é a que foi informada na hora que
        // instanciei o router
        $result = $router->handler();

        // pego o valor atual, note que estou executando o método que
        // registrei quando usei o $router->add
        $actual = $result();

        // o valor que espero que seja retornado pelo $actual
        $expected = true;

        // verifique se deu tudo certo
        $this->assertEquals($expected, $actual);
    }

    public function testVerificaNaoSeEncontraRota()
    {
        $router = new Router('GET', '/outra-url'); // esta rota não foi registrada

        // esta rota não é a que está sendo usada
        $router->add('GET', '/ola-mundo', function () {
            return true;
        });

        $result = $router->handler();

        $actual = $result;
        $expected = true;

        // estou usando o assertNotEquals
        // que verifica se os valores são diferentes
        // antes eu usei o assertEquals
        // que verifica se eles são iguais
        $this->assertNotEquals($expected, $actual);
    }

    public function testVerificaSeEncontraRotaVariavel()
    {
        $router = new Router('GET', '/ola-erik');
        $router->add('GET', '/ola-{nome}', function () {
            return true;
        });

        $result = $router->handler();

        $actual = $result();
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
}
