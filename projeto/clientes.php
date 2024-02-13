<?php include("conexao.php");

$sql_clientes = "SELECT * FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die(mysqli->error);
$num_clientes = $query_clientes->num_rows;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
</head>
<body>
<!--  tr>td*7  -->
    <h1>Lista de clientes cadastrados</h1>
    <p>Essa á e lista de clientes cadastrados: </p>
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data de cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if($num_clientes == 0 ) { ?>
                 <tr>
                    <td colspan="7">Nenhum cliente cadastrado </td>
                </tr>
            <?php } else {

              while($cliente = $query_clientes -> fetch_assoc()){

                $telefone = "";
                if(!empty($cliente['telefone'])) {
                    $ddd = substr ($cliente['telefone'], 0, 2);
                    $part1 = substr ($cliente['telefone'], 2, 5);
                    $part2 = substr ($cliente['telefone'], 7);
                    $telefone = "($ddd) $part1-$part2";
                }
                 $nascimento = "não informado";
                if(!empty($cliente['dt_nascimento'])) {
                    $nascimento = implode('/',array_reverse(explode('-', $cliente['dt_nascimento'])));
                }

                $dt_cadastro = date("d/m/Y H:i",strtotime($cliente['dt_cadastro']));
            
            ?>
           
            <tr>
                <td> <?php echo $cliente['id']; ?> </td>
                <td> <?php echo $cliente['nome']; ?> </td>
                <td> <?php echo $cliente['email']; ?> </td>
                <td> <?php echo $telefone; ?> </td>
                <td> <?php echo $nascimento; ?> </td>
                <td> <?php echo  $dt_cadastro; ?> </td>
                <td>
                    <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                    <a href="deletar_cliente.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                </td>
            </tr>

            <?php
              }
            }
            ?>
           
        </tbody>
    </table>
    <br><br><button><a href="cadastrar_clientes.php">Castrar cliente</a></button>
</body>
</html>