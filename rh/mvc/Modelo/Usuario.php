<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const BUSCAR_POR_ID = 'SELECT * FROM usuarios WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(nome, email, senha) VALUES (?, ?, ?)';
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $senhaPlana;
    private $tipo;

    public function __construct(
        $nome,
        $email,
        $senhaPlana,
        $tipo = null,
        $id = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
        $this->senhaPlana = $senhaPlana;

        if ($senhaPlana != null) {

            $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
            echo $this->senha;
        }
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
                ''
            );
            $tipo = $registro['tipo'];
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
                ''
            );
            $objeto = $registro['tipo'];
            $objeto->senha = $registro['senha'];
        }

        return $objeto;
    }
}
