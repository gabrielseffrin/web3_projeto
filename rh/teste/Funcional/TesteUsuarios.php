<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');

        $this->verificarContem($resposta, 'Sign up now');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'email' => 'mario@teste.com',
            'senha' => '123',
            'nome'  => 'nome',
            'situacao'      => '',
            'id'    => null,
            'tipo'  => ''
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuarios/sucesso');
        $resposta = $this->get(URL_RAIZ . 'usuarios/sucesso');
        $this->verificarContem($resposta, 'Parabéns!');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE email = "mario@teste.com"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }
}
