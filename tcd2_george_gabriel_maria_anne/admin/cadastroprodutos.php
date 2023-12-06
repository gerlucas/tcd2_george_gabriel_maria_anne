<?php
require_once '../classes/util.class.php';
require_once '../classes/usuarioservices.class.php';

Util::validarAcesso(['Administrador', 'Gerente']);

if (isset($_GET['nome']) && isset($_GET['preco']) && isset($_GET['descricao'])) {
    UsuarioServices::salvarProduto($_GET['nome'], $_GET['preco'], $_GET['descricao']);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebDev - Restaurante</title>
    <link rel="stylesheet" href="../styles/loginform.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>

<body>
    <main>
        <div class="container" id="container">
            <div class="form-container login">
                <form method="get" action="">
                    <h1>Cadastro</h1>
                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] === 'email_duplicado') {
                        echo '<p style="color: red;">E-mail já cadastrado. Por favor, escolha outro.</p>';
                    }
                    ?>
                    <span>Adicione os dados do produto</span>
                    <input type="text" name="nome" placeholder="Nome" id="nome">
                    <input type="number" name="preco" placeholder="Preço" id="preco">
                    <input type="text" name="descricao" placeholder="Descrição" id="descricao">
                    <button>Cadastrar</button>
                    <a class="link paginicial" href="../index.php">Página Inicial</a>
                </form>
            </div>
            <div class="container-info">
                <div class="info">
                    <div class="info-panel info-right">
                        <h2>Realize o cadastro de um novo produto</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>