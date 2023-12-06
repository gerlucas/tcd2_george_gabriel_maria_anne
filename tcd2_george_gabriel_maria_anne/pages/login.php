<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../styles/loginform.css">

    <title>DevWeb - Restaurante</title>
</head>

<body>
    <main>
        <div class="container" id="container">
            <div class="form-container login">
                <form method="get" action="/tcd2_george_gabriel_maria_anne/autenticar.php">
                    <h1>Login</h1>
                    <span>Use seu email e senha</span>
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <button>Entrar</button>
                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] === 'dados_incorretos') {
                        echo '<p style="color: red; text-align: center;">Dados incorretos. Tente novamente</p>';
                    }
                    if (isset($_GET['erro']) && $_GET['erro'] === 'sem_autenticacao') {
                        echo '<p style="color: red; text-align: center;">Você não está logado. Tente novamente</p>';
                    }
                    ?>
                    <a class="link paginicial" href="../index.php">Página Inicial</a>
                </form>
            </div>
            <div class="container-info">
                <div class="info">
                    <div class="info-panel info-right">
                        <h1>Bem vindo(a) de volta!</h1>
                        <p>Entre com seus dados pessoas para usar o nosso sistema</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/loginform.js"></script>
</body>

</html>