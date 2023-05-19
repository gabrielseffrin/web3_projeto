<?php
namespace Controlador;


use \Modelo\Usuario;
use \Framework\DW3Sessao;

class UsuarioControlador extends Controlador
{   

    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function armazenar()
    {
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], null, null, null);

        if ($usuario->isValido()) {
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
    }

    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
   
    public function mudarSituacao($id_usuario) {
        $this->verificarLogado();

        $usuario = DW3Sessao::get('usuario')[0];
        
        $acao = $_POST['acao'];
        
        if ($usuario == 1) {
            
            switch ($acao) {
                case 'Convidar':
                    Usuario::updateSituacao($id_usuario, 'convidado');
                  
                    DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Convidado - ');

                    $this->redirecionar(URL_RAIZ . 'home');
                    break;
                case 'Remover Convite':  
                    Usuario::updateSituacao($id_usuario, 'disponivel');

                    DW3Sessao::setFlash('mensagemFlash', 'Situação Alterada! - Convite Removido - ');

                    $this->redirecionar(URL_RAIZ . 'home');
                    break;                
            }
        } else if ($usuario == 2) {
            switch ($acao) {
                case 'Contratar':
                    Usuario::updateSituacao($id_usuario, 'contratado');
                    $this->redirecionar(URL_RAIZ . 'home');
                    break;               
            }
        }
    
        //$this->redirecionar(URL_RAIZ . 'usuarios/sucesso');
    }
}
