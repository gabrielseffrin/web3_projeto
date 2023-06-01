<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;

class TesteAlterarSituacao extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('', 'programador@teste', '123', null, null, null);
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeAlterarSituacaoPeloChefeConvidar()
    {
        $this->logarComoChefe();

        $usuario = new Usuario('', 'programador@teste', '123', null, null, null);
        $usuario->salvar();
        $usuarioId = $usuario->getId();
        
        $id_chefe = DW3Sessao::get('usuario');
        

            (Usuario::updateSituacao($usuarioId, 'convidado') );
            $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE situacao = 'convidado' AND id = " . $usuarioId);
            $bdMensagem = $query->fetch();
            $this->verificar($bdMensagem['email'] === 'programador@teste');

    }

    public function testeAlterarSituacaoPeloChefeDesconvidar()
    {
        $this->logarComoChefe();

        $usuario = new Usuario('', 'programadorConvida@teste', '123', null, null, null);
        $usuario->salvar();
        $usuarioId = $usuario->getId();

        $id_chefe = DW3Sessao::get('usuario');
        
 
            (Usuario::updateSituacao($usuarioId, 'disponivel') );
            $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE situacao = 'disponivel' AND id = " . $usuarioId);
            $bdMensagem = $query->fetch();
            $this->verificar($bdMensagem['email'] === 'programadorConvida@teste');
 
    }

    public function testeAlterarSituacaoPeloRhContratar()
    {
        $this->logarComoRh();

        $usuario = new Usuario('', 'programadorRh@teste', '123', null, null, null);
        $usuario->salvar();
        $usuarioId = $usuario->getId();

        $id_rh = DW3Sessao::get('usuario');
          
            (Usuario::updateSituacao($usuarioId, 'contratado') );
            $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE situacao = 'contratado' AND id = " . $usuarioId);
            $bdMensagem = $query->fetch();
            $this->verificar($bdMensagem['email'] == 'programadorRh@teste');

    }

    public function testeAlterarSituacaoProgramador()
    {
        $this->logarComoProgramador();
        //$this->verificarLogado();

        $usuario = new Usuario('', 'programadorRh@teste', '123', null, null, null);
        $usuario->salvar();
        $usuarioId = $usuario->getId();

        $id_programador = DW3Sessao::get('usuario');
        
            (Usuario::updateSituacao($id_programador, 'contratado') );
            $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE situacao = 'contratado' AND id = " . $id_programador);
            $bdMensagem = $query->fetch();

            $this->verificar($bdMensagem['email'] == 'programadorRh@teste');
    }


   

    /*public function testeBuscarTodos()
    {
        (new Mensagem($this->usuarioId, 'Ola pessoal'))->salvar();
        (new Mensagem($this->usuarioId, 'Segunda mensagem'))->salvar();
        $mensagens = Mensagem::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }

    public function testeContarTodos()
    {
        (new Mensagem($this->usuarioId, 'Ola pessoal'))->salvar();
        (new Mensagem($this->usuarioId, 'Segunda mensagem'))->salvar();
        $total = Mensagem::contarTodos();
        $this->verificar($total == 2);
    }

    public function testeDestruir()
    {
        $mensagem = new Mensagem($this->usuarioId, 'Ola pessoal');
        $mensagem->salvar();
        Mensagem::destruir($mensagem->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    } */
}
