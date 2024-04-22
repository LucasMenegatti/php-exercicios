<?php

include('conexao.php');

$sql_clientes = "SELECT * FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;


function formata_telefone($telefone) {
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone, 2, 5);
    $parte2 = substr($telefone, 7);
    return "($ddd) $parte1-$parte2";
}

function formata_data($data) {
    $tmp = explode('-', $data);
    $tmp = array_reverse($tmp);
    return implode('/', $tmp);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/projeto/css/styles.css">
</head>
<body>    
    <main class="clientes__main">
        <div class="clientes">
            <h1>Lista de Clientes</h1>
            <table class="tabela">
                <thead style="text-align:center;">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Nascimento</th>
                    <th>Data</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php if($num_clientes == 0) { ?>
                        <tr>
                            <td colspan="7" style="text-align:center;font-weight:bold;padding-top:1rem;">Nenhum cliente foi cadastrado</td>
                        </tr>
                    <?php } else { 
                        while($cliente = $query_clientes->fetch_assoc()) { ?>
                            <tr style="text-align:center;">
                                <td><?php echo $cliente['id'] ?></td>
                                <td><?php echo $cliente['nome'] ?></td>
                                <td><?php echo $cliente['email'] ?></td>
                                <td><?php echo empty($cliente['telefone']) ? "N.I." : formata_telefone($cliente['telefone']) ?></td>
                                <td><?php echo $cliente['nascimento'] == "0000-00-00" ? "N.I." : formata_data($cliente['nascimento']) ?></td>
                                <td><?php echo date("d/m/Y H:i", strtotime($cliente['data'])) ?></td>
                                <td>
                                    <a href="editar_cliente.php?id=<?php echo $cliente['id'] ?>" style="color:white;margin-right:.4rem;font-size:1.2rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                    <a href="deletar_cliente.php?id=<?php echo $cliente['id'] ?>" style="color:white;font-size:1.2rem;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Excluir"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                    <?php }} ?>
                </tbody>
            </table>
            <button class="btn btn-primary" style="display:block;margin-left:auto;margin-top:2rem;width:180px;" onclick="window.location.href='cadastrar_cliente.php';">Novo Cliente</a>
        </div>
    </main> 
</body>
</html>