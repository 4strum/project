<?php

function limpar_texto($str){ 
    return preg_replace("/[^0-9]/", "", $str); 
  }
  

if(count($_POST) > 0){
    include('conexao.php');

    $erro = false; 
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $dt_nascimento = $_POST["dt_nascimento"];

    if(empty($nome)){
        $erro = "Preencha o nome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o e-mail";
    }

    if(!empty($dt_nascimento)) {
        $pedaços = explode('/', $dt_nascimento);
        if(count($pedaços) == 3) {
            $dt_nascimento = implode ("-", array_reverse($pedaços)) ;    
        }
    else {
        $erro = "A data de nascimento deve seguir o padrão data/mes/ano.";
    }
    } 
    if(!empty($telefone)){
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11){
            $erro = "O telefone deve ser preenchido no padrao '(48) 98888-7777' .";
        }
    }


    if($erro) {
        echo "<p></b>Erro: $erro</b></p>";
    }else{
     $sql_code = "INSERT INTO clientes (nome, email, telefone, dt_nascimento, dt_cadastro) VALUES('$nome', '$email', '$telefone', '$dt_nascimento', NOW())";
     $deu_certo = $mysqli -> query($sql_code) or die($mysqli -> error);
     if($deu_certo) {
        echo "<p><b>Cliente cadastrado</b></p>";
        unset($_POST);
     }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
</head>
<body> 

    <a href="clientes.php">Voltar para a lista</a>
    <form method="POST" action="">
        <p>
            <label>Nome</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>"  name= "nome" type="text"><br>
        </p>

        <p>
            <label>E-mail</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" name= "email" type="text"><br>
        </p>

        <p>
            <label>Telefone</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" placeholder="(48) 98888-7777" name= "telefone" type="text"><br>
        </p>


        <p>
            <label>Data de nascimento</label>
            <input value="<?php if(isset($_POST['dt_nascimento'])) echo $_POST['dt_nascimento'];?>" name= "dt_nascimento" type="text"><br>
        </p>

        <p>
            <button type="submit">Enviar</button>
        </p>
    </form>

</body>
</html>