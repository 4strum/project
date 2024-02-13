<?php
 include('conexao.php');
 $id = intval($_GET['id']);
 

function limpar_texto($str){ 
    return preg_replace("/[^0-9]/", "", $str); 
  }
  

if(count($_POST) > 0){
   

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
        echo "<p><b>ERRO: $erro</b></p>";
    } else {
        $sql_code = "UPDATE clientes
        SET nome = '$nome', 
        email = '$email', 
        telefone = '$telefone',
        dt_nascimento = '$dt_nascimento'
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            echo "<p><b>Cliente atualizado com sucesso!!!</b></p>";
            unset($_POST);
        }
    }

}


$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_clientes = $mysqli->query($sql_cliente) or die(mysqli->error);
$cliente = $query_clientes->fetch_assoc();
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
            <input value="<?php echo $cliente['nome'];?>"  name= "nome" type="text"><br>
        </p>

        <p>
            <label>E-mail</label>
            <input value="<?php echo $cliente['email'];?>" name= "email" type="text"><br>
        </p>

        <p>
            <label>Telefone</label>
            <input value="<?php if(!empty($cliente['telefone'])) echo formatar_telefone($cliente['telefone']) ?>" placeholder="(48) 98888-7777" name= "telefone" type="text"><br>
        </p>


        <p>
            <label>Data de nascimento</label>
            <input value="<?php  if(!empty($cliente['dt_nascimento'])) echo formatar_data($cliente['dt_nascimento']);?>" name= "dt_nascimento" type="text"><br>
        </p>

        <p>
            <button type="submit">Salvar Cliente</button>
        </p>
    </form>

</body>
</html>