<?php

include("conexao.php");

$id = intval($_GET['id']);

function limpar_texto($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

function mostra_erro($erro) {
    echo "<p><b>$erro</b></p>";
}


if(count($_POST) > 0) {

    $erro = FALSE;
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];


    if(empty($nome)) {
        $erro = TRUE;
        mostra_erro("Preencha o nome.");
    }

    if((empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) && !$erro) {
        $erro = TRUE;
        mostra_erro("Preencha o e-mail.");
    }

    if(!empty($telefone) && !$erro) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11) {
            $erro = TRUE;
            mostra_erro("O telefone deve ser preenchido no padrão (11) 98888-8888");
        }
    }

    if(!empty($nascimento) && !preg_match('/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/', $nascimento) && !$erro) {
        $erro = TRUE;
        mostra_erro("A data de nascimento está em um formato inválido!");
    };

    if(!$erro) {
        $sql_code = "UPDATE clientes SET
            nome = '$nome',
            email = '$email',
            telefone = '$telefone',
            nascimento = '$nascimento'
        WHERE id= '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            echo "<p><b>Cliente atualizado com sucesso!</b></p>";
            unset($_POST);
        };
    }
}

$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

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
        <h1>Editar o cadastro de <i><?php echo $cliente['nome']; ?></i></h1>
        <form id="formulario" data-bs-theme="dark" method="POST" action="">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input value="<?php echo $cliente['nome']; ?>" type="text" placeholder="Nome Completo" class="form-control" id="nome" name="nome">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="<?php echo $cliente['email']; ?>" type="email" placeholder="email@provedor.com.br" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input value="<?php echo $cliente['telefone']; ?>" type="text" placeholder="(11) 98888-8888" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="mb-3">
                <label for="nascimento" class="form-label">Data de Nascimento</label>
                <input value="<?php echo $cliente['nascimento']; ?>" type="date" class="form-control" id="nascimento" name="nascimento">
            </div>
        </form>
        <div style="margin-top:1rem;">
            <button class="btn btn-secondary" style="margin-right:1rem;" onclick="window.location.href='clientes.php';">Voltar</a>
            <button type="submit" form="formulario" class="btn btn-primary" style="width:180px">Salvar</button>
        </div>
    </main>
</body>
</html>