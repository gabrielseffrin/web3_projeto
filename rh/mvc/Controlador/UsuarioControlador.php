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
}
