<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class Mensagem extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios WHERE tipo = "programador" AND situacao = "disponivel" OR situacao = "convidado"';
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO mensagens(usuario_id,texto) VALUES (?, ?)';
    const DELETAR = 'DELETE FROM mensagens WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM mensagens';
    private $id;
    private $usuarioId;
    private $texto;
    private $usuario;

    public function __construct(
        $usuarioId,
        $texto,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->texto = $texto;
        $this->usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->texto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarConvites($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto =  new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['tipo'],
                $registro['id'],
                $registro['situacao']
            );
        }
        
        return $objeto;
    }

    /* Além de buscar as mensagens, eu também busco, na mesma consulta,
    os dados dos usuários, usando um JOIN. Essa é a forma correta de
    resolver o problema: query N+1. Com apenas uma consulta no banco
    eu busco tudo que eu preciso.
    */
    public static function buscarProgramadores($acao)
    {
        $registros = null;
        $objetos = [];
        $objeto = null;

        switch ($acao) {
            case 1:
                $comando = DW3BancoDeDados::query(self::BUSCAR_TODOS);
                $registros = $comando->fetchAll();
                break;
            case 2:
                $comando = DW3BancoDeDados::query(self::BUSCAR_CONVIDADOS);
                $registros = $comando->fetchAll();
                break;
            default:
                break;
        }
        
        foreach ($registros as $registro) {
            
            $objetos[] = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['tipo'],
                $registro['id'],
                $registro['situacao']
            );

        }


        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}
