<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Chefe;
use \Modelo\Usuario;

class ChefeControlador extends Controlador
{
    

    private function getProgramadores()
    {
    
        $programadores = Chefe::buscarProgramadores();
        return compact('programadores');
    }

    private function getProgramadoresPorNome($nome)
    {
    
        $programadores = Chefe::buscarPorNome($nome);
        return compact('programadores');
    }

    public function index()
    {
       
        $this->verificarLogado();

        $conteudo = $this->getProgramadores();
        
        $this->visao('chefe/index.php',  
            [
                'programadores' => $conteudo['programadores'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);     
    }

    public function buscar() {
        $this->verificarLogado();

        $nome = $_POST['buscarPorNome'];      

        $conteudo = $this->getProgramadoresPorNome($nome);
        
        $this->visao('chefe/index.php',  
            [
                'programadores' => $conteudo['programadores'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);

    }


    public function convidar($id_usuario) {
        $this->verificarLogado();

        Usuario::updateSituacao($id_usuario, 'convidado');
                  
        DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Convidado - ');

        $this->redirecionar(URL_RAIZ . 'chefe/listaConvite');

    }

    public function desconvidar($id_usuario) {
        $this->verificarLogado();
       
        Usuario::updateSituacao($id_usuario, 'disponivel');
                  
        DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Convidado - ');

        $this->redirecionar(URL_RAIZ . 'chefe/listaConvite');

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
