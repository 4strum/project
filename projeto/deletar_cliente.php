<?php
if(isset($_POST['Confirmar'])){
    include('conexao.php');
    $id = intval($_GET['id']);
    $sql_code = "DELETE  FROM  clientes WHERE id= '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
   
    if($sql_query){ ?>
        <h1>Cliente foi deletado com sucesso!</h1>
        <p><a href="clientes.php">Clique aqui</a>para voltar a lista de clientes.</p> 
       
        <?php 
        die();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente!</title>
</head>
<body>
    <H1>Confirmar exclusão do cliente?</H1>

    <form method="post" action="">
    <button name="Confirmar" value="1" type="submit">SIM</button>
    <button><a href="clientes.php">NÃO</a></button>
    </form>
  
</body>
</html>