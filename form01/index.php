<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário - Método POST</title>
    <link rel="stylesheet" href="/css/bootstrap-css/bootstrap.min.css">
    <style>
        body {
            background-color: #212529;
            color: white;
            height: 100vh;
            max-height: 100%;
        }

        main {
            max-width: 800px;
            height: 100%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            min-width: 600px;
        }

        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }

        textarea {
            resize: none;
        }

        button {
            display: block;
            width: 30%;
            margin-top: 1.5rem;
        }

        .dados_preenchidos {
            position: fixed;
            z-index: 9;
            background-color: black;
            min-width: 200px;
            max-width: 300px;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            padding: .5rem;
        }

    </style>
</head>
<body>
    <div class="dados_preenchidos">
        <?php
            // === Filtro de Spam ===
            function filtro_spam($texto) { // Se for FALSE, significa que o texto TÊM conteúdo geralmente relacionado a spam
                return !preg_match("/^jpg|jpeg|png|pdf|php|php5|xml|html|free|dating|porn|sex|funding|inbound|game|bitcoin|и|д|й|л/i", $texto);
            };

            function morrer() {
                http_response_code(422);
                header("Refresh:0"); // Aqui seria o die();
            }

            // ==== Validação ===
            if(isset($_POST['enviar'])) {
                $nome = !empty($_POST['nome']) && filtro_spam($_POST['nome']) ? $_POST['nome'] : morrer(); // Campo Obrigatório
                $email = !empty($_POST['email']) && filtro_spam($_POST['email']) ? $_POST['email'] : morrer(); // Campo Obrigatório
                $site = filtro_spam($_POST['site']) ? $_POST['site'] : morrer();
                $mensagem = filtro_spam($_POST['mensagem']) ? $_POST['mensagem'] : morrer();
                $genero = isset($_POST['genero']) && $_POST['genero'] == ("Masculino" || "Feminino" || "Outro") ? $_POST['genero'] : morrer();

            // === Tratamento dos Dados ===
                echo "<p><b>Nome:</b> " . $nome . "</p>";
                echo "<p><b>E-mail:</b> " . $email . "</p>";
                echo "<p><b>Site:</b> " . $site . "</p>";
                echo "<p><b>Mensagem:</b> " . $mensagem . "</p>";
                echo "<p><b>Gênero:</b> " . $genero . "</p>";
            };
        ?>
    </div>

    <main>
        <form data-bs-theme="dark" method="POST" action="">
            <h1>Este é meu formulário!</h1>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="site" class="form-label">Website</label>
                <input type="text" class="form-control" id="site" name="site">
            </div>
            <div class="mb-3">
                <label for="mensagem" class="form-label">Mensagem</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="5"></textarea>
            </div>
            <p>Gênero</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="genero" value="Masculino">
                <label class="form-check-label" for="genero">Masculino</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="genero" value="Feminino">
                <label class="form-check-label" for="genero">Feminino</label>
            </div>
            <button name="enviar" type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main> 
</body>
    <script src="/js/bootstrap-js/bootstrap.min.js"></script>
</html>