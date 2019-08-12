<?php

namespace ErikFig\Framework;

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * Com PHPUnit toda classe precisa terminar com Test,
     * como por exemplo, RouterTest.
     * 
     * Todo método de teste precisa iniciar com test e
     * descrever o que ele está testando, como 
     * testEsseMetodoDescreveOQueDeveAcontecer()
     *
     * @return void
     */
    public function testEsseMetodoDescreveOQueDeveAcontecer()
    {
        // o valor que eu quero testar
        $actual = (new Router)->handler();
        $expected = true; // o valor que eu espero

        /**
         * O método assertEquals é provido pela classe TestCase
         * que a RouterTest (esta que estamos) está herdando
         * ele verifica se o valor esperado (expected) é igual
         * ao valor atual (actual);
         */
        $this->assertEquals($expected, $actual);
    }
}
