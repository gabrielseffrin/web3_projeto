<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogin()
    {
        (new Usuario('fulano', 'fulano@teste.com', '123', null, null, null))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'fulano@teste.com',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'programador/perfil');
        $this->verificar(DW3Sessao::get('usuario-id') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'fulano@teste.com',
            'senha' => '123'
        ]);
        $this->verificarContem($resposta, 'Usuário ou senha inválido');
        $this->verificar(DW3Sessao::get('usuario-id') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('fulano', 'fulano@teste.com', '123', null, null, null))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'fulano@teste.com',
            'senha' => '123'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario-id') == null);
    }
}
