<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
	public function testeInserir()
	{
        new Usuario('nome', 'email', 'senha', null, null, null);

        $usuario = new Usuario('nome', 'email-teste', 'senha', null, null, null);
        $usuario->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE email = 'email-teste'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
	}

    public function testeBuscarEmail()
    {
        $usuario = new Usuario('nome', 'email-teste', 'senha', null, null, null);
        $usuario->salvar();
        $usuario = Usuario::buscarEmail('email-teste');
        $this->verificar($usuario !== false);
    }
}
