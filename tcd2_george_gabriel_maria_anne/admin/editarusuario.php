<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/usuarioservices.class.php';

Util::validarAcesso(['Administrador']);

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = R::load('usuarios', $id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome']) && isset($_POST['perfil']) && isset($_POST['email']) && isset($_POST['id']) && isset($_POST['debito'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $perfil = $_POST['perfil'];
        $email = $_POST['email'];
        $debito = $_POST['debito'];
        $ativo = isset($_POST['ativo']) ? 1 : 0;
        $carteira = isset($_POST['carteira']) ? 1 : 0;

        UsuarioServices::editarUsuario($id, $nome, $perfil, $email, $ativo, $carteira, $debito);

        $usuario = R::load('usuarios', $id);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/userstable.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/navbar.css">
    <title>WebDev - Restaurante</title>
</head>

<body>
    <main class="table">
        <section class="table__header">
            <h1>Editar Usuário</h1>
            <a class="link paginicial" href="../admin/listausuarios.php">Voltar</a>
            <a class="link paginicial" href="../index.php">Página Inicial</a>
            <div class="export__file">
            </div>
        </section>
        <section class="table__body">
            <form action="" method="post">
                <table>
                    <thead>
                        <tr>
                            <th> Id <span class="icone"><i class="uil uil-tag"></i></i></span></th>
                            <th> Nome <span class="icone"><i class="uil uil-user"></i></span></th>
                            <th> Cargo <span class="icone"><i class="uil uil-bag-alt"></i></span></th>
                            <th> Email <span class="icone"><i class="uil uil-at"></i></span></th>
                            <th> Ativo <span class="icone"><i class="uil uil-chart-bar"></i></span></th>
                            <th> Habilitar Carteira <span class="icone"><i class="uil uil-chart-bar"></i></span></th>
                            <th> Débito <span class="icone"><i class="uil uil-dollar-alt"></i></span></th>
                            <th> Data do Cadastro <span class="icone"><i class="uil uil-calender"></i></span></th>
                            <th> Data da Edição <span class="icone"><i class="uil uil-calender"></i></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($usuario)) : ?>
                            <tr>
                                <td><?php echo $usuario->id; ?></td>
                                <td><input type="text" name="nome" id="nome" value="<?php echo $usuario->nome; ?>"></td>
                                <td>
                                    <select name="perfil" id="perfil">
                                        <option value="Administrador">Administrador</option>
                                        <option value="Gerente">Gerente</option>
                                        <option value="Caixa">Caixa</option>
                                        <option value="Cliente">Cliente</option>
                                    </select>
                                </td>
                                <td><input type="email" name="email" id="email" value="<?php echo $usuario->email; ?>"></td>
                                <td><input type="checkbox" name="ativo" id="ativo" <?php echo $usuario->ativo ? 'checked' : ''; ?>></td>
                                <td><input type="checkbox" name="carteira" id="carteira" <?php echo $usuario->carteira ? 'checked' : ''; ?>></td>
                                <td><input type="number" name="debito" id="debito" value="<?php echo $usuario->debito; ?>">
                                </td>
                                <td><?php echo $usuario->data_cadastro; ?></td>
                                <td><?php echo $usuario->data_edicao; ?></td>
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button class="form_button">Finalizar alterações</button>

            </form>
        </section>

        <?php include '../components/footer.component.php' ?>
    </main>

    
    <script>
        document.getElementById('ativo').addEventListener('change', function() {
            console.log('Valor do checkbox:', this.checked);
        });
    </script>
    <script src="../js/userstable.js"></script>
<script src="./js/navbar.js"></script>
</body>

</html>