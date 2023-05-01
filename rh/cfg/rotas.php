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
        'GET' =>  '\Controlador\UsuarioControlador#redirecionarPorTipo',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/mensagens' => [
        'GET' => '\Controlador\MensagemControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar',
    ],
    '/mensagens/?' => [
        'DELETE' => '\Controlador\MensagemControlador#destruir',
    ],
];
