<?php
require_once '../classes/util.class.php';
require_once '../classes/usuarioservices.class.php';

Util::validarAcesso(['Administrador', 'Gerente']);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nome']) && isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['perfil'])  && isset($_GET['pin'])){
    $nome = $_GET['nome'];
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    $perfil = $_GET['perfil'];
    $pin = $_GET['pin'];
    $carteira = isset($_GET['habilitarCarteira']) ? ($_GET['habilitarCarteira'] ? 1 : 0) : 0;

    if (Util::isLogado()) {
        $perfilUsuarioLogado = isset($_SESSION['perfil']) ? $_SESSION['perfil'] : null;

        if ($perfilUsuarioLogado === 'Administrador') {
            UsuarioServices::salvarUsuario($nome, $email, $senha, $perfil, $carteira, $pin);
        } elseif ($perfilUsuarioLogado === 'Gerente') {
            if ($perfil === 'Cliente') {
                UsuarioServices::salvarUsuario($nome, $email, $senha, $perfil, $carteira, $pin);
            } else {
                echo 'Gerentes só podem cadastrar clientes.';
            }
        } else {
            echo 'Você não tem permissão para realizar esta ação.';
        }
    } else {
        echo 'Você precisa estar logado para realizar esta ação.';
    }
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
                        echo '<p style="color: red;">E-mail já cadastrado. Escolha outro.</p>';
                    }
                    if (isset($_GET['erro']) && $_GET['erro'] === 'pin_duplicado') {
                        echo '<p style="color: red;">PIN já cadastrado. Escolha outro.</p>';
                    }
                    ?>
                    <span>Adicione os dados do usuário</span>
                    <input type="text" name="nome" id="nome" placeholder="Nome" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    <input type="number" name="pin" id="pin" placeholder="PIN" required maxlength="4">
                    <select name="perfil" id="perfil" onchange="mostrarCheckbox()">
                        <option value="Administrador">Administrador</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Caixa">Caixa</option>
                        <option value="Cliente">Cliente</option>
                    </select>

                    <div id="checkboxDiv" style="display: none;">
                        <label for="habilitarCarteira">Habilitar Carteira</label>
                        <input type="checkbox" id="habilitarCarteira" name="habilitarCarteira">
                    </div>
                    <button>Cadastrar</button>
                    <a class="link paginicial" href="../index.php">Página Inicial</a>
                </form>
            </div>
            <div class="container-info">
                <div class="info">
                    <div class="info-panel info-right">
                        <h2>Realize o cadastro de um novo usuário</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="../js/cadastroform.js"></script>
</body>

</html>