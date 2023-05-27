<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/criar.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarEmail($_POST['email']);

       
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {

            DW3Sessao::set('usuario-id', $usuario->getId());

            $id_usuario = DW3Sessao::get('usuario-id');

            if ($id_usuario == 1) {
                
                $this->redirecionar(URL_RAIZ . 'chefe/listaConvite');

            } else if ($id_usuario == 2) {

                $this->redirecionar(URL_RAIZ . 'Rh/listaContratacao');

            } else if ($id_usuario > 2) {
                $this->redirecionar(URL_RAIZ . 'programador/perfil');
            }
            
            $this->redirecionar(URL_RAIZ . 'login');
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
