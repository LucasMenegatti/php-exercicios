<?php 

include("conexao.php");
$id = intval($_GET['id']);

$sql_cliente = "SELECT nome FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

if(isset($_POST['deletar'])) {
    $sql_code = "DELETE FROM clientes WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    header("Location: /projeto/clientes.php");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="/projeto/css/styles.css">
    
</head>
<body>
    <main>
        <h1>Deletar cadastro de: <i><?php echo $cliente['nome']?></i> ?</h1>
        <form id="deletar" action="" method="POST"></form>
        <div style="margin-top:1rem;">
            <button class="btn btn-secondary" style="margin-right:1rem;" onclick="window.location.href='clientes.php';">Não, Voltar</a>
            <button type="submit" name="deletar" value="1" form="deletar" class="btn btn-danger" style="width:180px">SIM, DELETAR</button>
        </div>
    </main>
</body>
</html>