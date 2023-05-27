<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class Chefe extends Usuario
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios WHERE tipo = "programador" AND situacao = "disponivel" OR situacao = "convidado" ORDER BY nome ASC';
    const BUSCAR_CONVIDADOS = 'SELECT * FROM usuarios WHERE tipo = "programador" AND situacao = "aceite"  ORDER BY nome ASC';
    const BUSCAR_NOME = 'SELECT * FROM usuarios WHERE nome like ? AND tipo = "programador" ORDER BY nome ASC';

    public static function buscarProgramadores()
    {
        $registros = null;
        $objetos = [];
        $objeto = null;

        $comando = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $registros = $comando->fetchAll();
        
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

    public static function buscarPorNome($nome) {

        $nome = '%' . $nome . '%';
               
        $registros = null;
        $objetos = [];
        $objeto = null;

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME);
        $comando->bindValue(1, $nome, PDO::PARAM_STR);
        $comando->execute();
        $registros = $comando->fetchAll();
        
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
}
