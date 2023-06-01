<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const BUSCAR_POR_ID = 'SELECT * FROM usuarios WHERE id = ? AND situacao = "convidado"';
    const INSERIR = 'INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)';
    const UPDATE_CONVITE = 'UPDATE `usuarios` SET  `situacao`= ? WHERE id = ?';

    private $id;
    private $email;
    private $nome;
    private $senha;
    private $senhaPlana;
    private $tipo;
    private $situacao;

    public function __construct(    $nome,        $email,        $senhaPlana,        $tipo,        $id = null,        $situacao    ) {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
        $this->senhaPlana = $senhaPlana;
        $this->tipo = $tipo;
        $this->situacao = $situacao;

        if ($senhaPlana != null) {

            $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
        }

        
    }

    public function getNome() {
        return $this->nome;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function verificarSenha($senhaPlana)
    {
       return password_verify($senhaPlana, $this->senha);
    }

    protected function verificarErros()
    {
        if (strlen($this->email) < 3) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
        }
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome,  PDO::PARAM_STR);
        $comando->bindValue(2, $this->email, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['tipo'],
                $registro['id'],
                $registro['situacao']
            );
            $objeto->tipo = $registro['tipo'];
            $objeto->situacao = $registro['situacao'];
            $objeto->senha = $registro['senha'];
            
        }

        return $objeto;
    }

    public static function buscaPorId($id)
    {  

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
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

    public static function updateSituacao($id_programador, $situacao) 
    {

        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::UPDATE_CONVITE);
        $comando->bindValue(2, $id_programador, PDO::PARAM_STR);
        $comando->bindValue(1, $situacao, PDO::PARAM_STR);
        $comando->execute();
        //$this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();

    }
}
