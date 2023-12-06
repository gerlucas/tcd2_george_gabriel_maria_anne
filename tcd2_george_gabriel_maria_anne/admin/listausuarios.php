<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');
Util::validarAcesso(['Administrador', 'Gerente']);
$usuarios = R::findAll('usuarios');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/userstable.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>WebDev - Restaurante</title>
</head>

<body>
    <main class="table">
        <section class="table__header">
            <h1>Consulta de Usuários</h1>
            <a class="link paginicial" href="../index.php">Página Inicial</a>
            <div class="input-group">
                <input type="search" placeholder="Procurar por usuário...">
                <img src="images/busca.png" alt="">
            </div>
            <div class="export__file">

            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id <span class="icone"><i class="uil uil-tag"></i></i></span></th>
                        <th> Nome <span class="icone"><i class="uil uil-user"></i></span></th>
                        <th> Cargo <span class="icone"><i class="uil uil-bag-alt"></i></span></th>
                        <th> Email <span class="icone"><i class="uil uil-at"></i></span></th>
                        <th> Ativo <span class="icone"><i class="uil uil-chart-bar"></i></span></th>
                        <th> Débito <span class="icone"><i class="uil uil-dollar-alt"></i></span></th>
                        <th> Data do Cadastro <span class="icone"><i class="uil uil-calender"></i></span></th>
                        <th> Data da Edição <span class="icone"><i class="uil uil-calender"></i></span></th>
                        <th> Editar <span class="icone"><i class="uil uil-edit"></i></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario->id; ?></td>
                            <td><?php echo $usuario->nome; ?></td>
                            <td>
                                <?php
                                $perfis = $usuario->sharedPerfilList;
                                foreach ($perfis as $perfil) {
                                    $classePerfil = strtolower($perfil->nome);
                                    echo "<p class='status $classePerfil'>$perfil->nome</p>";
                                }
                                ?>
                            </td>
                            <td><?php echo $usuario->email; ?></td>
                            <td><?php echo $usuario->ativo ? '<i class="uil uil-check"></i>' : '<i class="uil uil-times"></i>'; ?>
                            </td>
                            <td><?php echo $usuario->debito; ?></td>
                            <td><?php echo $usuario->data_cadastro; ?></td>
                            <td><?php echo $usuario->data_edicao; ?></td>
                            <td><a href='../admin/editarusuario.php?id=<?php echo $usuario->id ?>'><i class="uil uil-edit-alt"></i></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="../js/userstable.js"></script>
</body>

</html>