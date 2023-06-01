<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteMensagens extends Teste
{
    

   /*  public function testeListagem()
    {
        $this->logar();
        (new Usuario('fulano', 'fulano@teste.com', '123', null, null, null))->salvar();
        $resposta = $this->get(URL_RAIZ . 'programador/perfil');
        $this->verificarContem($resposta, 'Convites');
        //$this->verificarContem($resposta, 'Olá');
    }

    public function naoAcessarDeslogadorProgramador()
    {
        $resposta = $this->get(URL_RAIZ . 'programador/perfil');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function naoAcessarDeslogadorRh()
    {
        $resposta = $this->get(URL_RAIZ . 'Rh/listaContratacao');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function naoAcessarDeslogadorChefe()
    {
        $resposta = $this->get(URL_RAIZ . 'chefe/listaConvite');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeAlterarSituacaoChefe()
    {
        $this->logar();
       
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }

  
    
    /*
    public function testeDestruirDeOutroUsuario()
    {
        $this->logar();
        $outroUsuario = new Usuario('teste2@teste2.com', '123');
        $outroUsuario->salvar();
        $mensagem = new Mensagem($outroUsuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'mensagens/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao !== false);
    }*/
}
