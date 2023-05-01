<?php
namespace Controlador;
session_start();

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
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);

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

    public function redirecionarPorTipo() {
        $usuarioId = DW3Sessao::get('usuario' $_SESSION['usuario']);
        if (!isset($usuarioId)) {
            $this->redirecionar(URL_RAIZ);
            return;
        }
    
        $usuario = Usuario::buscaPorId($usuarioId);
        var_dump($usuario);
    
        switch ($usuario->tipo()) {
            case 'programador':
                $this->redirecionar(URL_RAIZ . 'programadores/perfil');
                break;
            case 'chefe':
                $this->redirecionar(URL_RAIZ . 'chefe/listagem');
                break;
            case 'rh':
                $this->redirecionar(URL_RAIZ . 'rh/listagem');
                break;
            default:
                $this->redirecionar(URL_RAIZ);
                break;
        }
    }
}
