<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;
use \Modelo\Usuario;

class MensagemControlador extends Controlador
{
    private $id_usuario = null;
    private function getProgramadores($acao)
    {
        $id_usuario = DW3Sessao::get('usuario');
        if ($acao == 3) {
            $convite = Usuario::buscaPorId($id_usuario[0]);
            return compact('convite');
        }
        $programadores = Mensagem::buscarProgramadores($acao);
        return compact('programadores');
    }

    public function index()
    {
        $this->verificarLogado();
        $id_usuario = DW3Sessao::get('usuario');
        
        switch ($id_usuario[1]) {
            case 'chefe':
                $conteudo = $this->getProgramadores(1);

                $this->visao('chefe/index.php',  
                [
                    'programadores' => $conteudo['programadores'],
                    'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
                ]);        
                break;
            case 'RH':
                $conteudo = $this->getProgramadores(2);

                $this->visao('rh/index.php',  
                [
                    'programadores' => $conteudo['programadores'],
                    'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
                ]);        
                break;
            default:
                $conteudo = $this->getProgramadores(3);


                $this->visao('programador/index.php',  
                [
                    'objeto' => $conteudo['objeto'],
                    'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
                ]);        
                break;
        }
        
       
    }



    public function armazenar()
    {
        $this->verificarLogado();
        $mensagem = new Mensagem(
            DW3Sessao::get('usuario'),
            $_POST['texto']
        );
        if ($mensagem->isValido()) {
            $mensagem->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem cadastrada.');
            $this->redirecionar(URL_RAIZ . 'mensagens');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => $paginacao['mensagens'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
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
