<?php

$host = "localhost";
$db = "crud_clientes";
$user = "root";
$pass = "";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli -> connect_errno) {
    dia("Falha na conexão com o banco de dados");
}

function formatar_data($data){
    return implode('/',array_reverse(explode('-', $data)));
}

function formatar_telefone($telefone){
     $ddd = substr ($telefone, 0, 2);
     $part1 = substr ($telefone, 2, 5);
     $part2 = substr ($telefone, 7);
     return "($ddd) $part1-$part2";
    
}