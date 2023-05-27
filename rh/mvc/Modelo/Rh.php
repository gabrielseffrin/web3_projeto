<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3Sessao;


class Rh extends Usuario
{
    const BUSCAR_CONVIDADOS = 'SELECT * FROM usuarios WHERE tipo = "programador" AND situacao = "aceite"';

    public static function contratar()
    {
        $registros = null;
        $objetos = [];
        $objeto = null;

        $comando = DW3BancoDeDados::query(self::BUSCAR_CONVIDADOS);
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
