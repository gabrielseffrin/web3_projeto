<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso'
    ],
    '/programador/perfil' => [
        'GET' => '\Controlador\ProgramadorControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar'
    ],

    '/programador/?/aceitar' => [
        'POST' => '\Controlador\ProgramadorControlador#aceitar'
    ],

    '/programador/?/recusar' => [
        'POST' => '\Controlador\ProgramadorControlador#recusar'
    ],

    '/chefe/listaConvite' => [
        'GET' => '\Controlador\ChefeControlador#index',
        'POST' => '\Controlador\ChefeControlador#armazenar'
    ],

    '/chefe/buscar' => [
        'POST' => '\Controlador\ChefeControlador#buscar'
    ],

    '/chefe/?/convidar' => [
        'POST' => '\Controlador\ChefeControlador#convidar'
    ],

    '/chefe/?/desconvidar' => [
        'POST' => '\Controlador\ChefeControlador#desconvidar'
    ],
    
    '/Rh/listaContratacao' => [
        'GET' => '\Controlador\RhControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar',
    ],

    '/Rh/?/contratar' => [
        'POST' => '\Controlador\RhControlador#contratar'
    ],

    '/acaoUsuario/?' => [
        'POST' => '\controlador\UsuarioControlador#mudarSituacao'
    ],

    '/mensagens/?' => [
        'DELETE' => '\Controlador\MensagemControlador#destruir',
    ],

];
