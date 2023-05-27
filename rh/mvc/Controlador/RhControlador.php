<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Rh;
use \Modelo\Usuario;

class RhControlador extends Controlador
{
    
    private function getProgramadores()
    {
     
        $programadores = Rh::contratar();
        return compact('programadores');
    }

    public function index()
    {
        $this->verificarLogado();

        $conteudo = $this->getProgramadores();

        $this->visao('rh/index.php',  
            [
                'programadores' => $conteudo['programadores'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);        
    }

    public function contratar($id_usuario) {
        $this->verificarLogado();
       
        Usuario::updateSituacao($id_usuario, 'contratado');
                  
        DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Contratado - ');

        $this->redirecionar(URL_RAIZ . 'Rh/listaContratacao');

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
