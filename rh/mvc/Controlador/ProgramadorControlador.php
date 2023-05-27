<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;
use \Modelo\Usuario;

class ProgramadorControlador extends Controlador
{

    private function getProgramadores()
    {
        
        $convite = Usuario::buscaPorId($this->getUsuario());

        
        return compact('convite');

    }

    public function index()
    {
        $this->verificarLogado();
       
        $conteudo = $this->getProgramadores();

        $this->visao('programador/index.php',  
            [
                'objeto' => $conteudo['convite'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);        
    }

    public function aceitar($id_usuario) {
        $this->verificarLogado();

        Usuario::updateSituacao($id_usuario, 'aceite');
        
        var_dump($id_usuario);
        DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Aceite - ');

        $this->redirecionar(URL_RAIZ . 'programador/perfil');

    }

    public function recusar($id_usuario) {
        $this->verificarLogado();



        Usuario::updateSituacao($id_usuario, 'disponivel');
                  
        DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Recusado - ');

        $this->redirecionar(URL_RAIZ . 'programador/perfil');

    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $mensagem = Mensagem::buscarId($id);
        if ($mensagem->getUsuarioId() == $this->getUsuario()) {
            Mensagem::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'mensagens');
    }
}
