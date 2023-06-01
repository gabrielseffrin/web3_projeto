<?php
namespace Teste;

use \Modelo\Usuario;
use \Framework\DW3Teste;
use \Framework\DW3Sessao;

class Teste extends DW3Teste
{
	protected $usuario;

	public function logarComoProgramador()
	{
		$this->usuario = new Usuario('', 'usuario@teste.com', '123', null, null, null);
		$this->usuario->salvar();
		DW3Sessao::set('usuario', $this->usuario->getId());
	}

	public function logarComoChefe()
	{
		$this->usuario = new Usuario('', 'teste@teste', '111', null, null, null);
		$this->usuario->salvar();
		DW3Sessao::set('usuario', $this->usuario->getId());
	}

	public function logarComoRh()
	{
		$this->usuario = new Usuario('', 'rh@rh', '111', null, null, null);
		$this->usuario->salvar();
		DW3Sessao::set('usuario', $this->usuario->getId());
	}
}
