<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

Util::validarAcesso(['Administrador', 'Gerente', 'Caixa']);

$usuarios = R::find('usuarios', '
    INNER JOIN vendas ON vendas.cliente_id = usuarios.id
    WHERE usuarios.ativo = 1
    GROUP BY usuarios.id
');

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
            <h1>Consultar Histórico de Consumo</h1>
            <a class="link paginicial" href="../index.php">Página Inicial</a>
            <div class="input-group">
                <input type="search" placeholder="Procurar por usuário...">
                <img src="../admin/images/busca.png" alt="">
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
                        <th> Data do Cadastro <span class="icone"><i class="uil uil-calender"></i></span></th>
                        <th> Consultar histórico <span class="icone"><i class="uil uil-invoice"></i></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario->id; ?></td>
                            <td><?php echo $usuario->nome; ?></td>
                            <td><?php echo $usuario->data_cadastro; ?></td>
                            <td><a href='../caixa/consultahistorico.php?id=<?php echo $usuario->id ?>'><i class="uil uil-file-check"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>    
            </table>
        </section>
    </main>

    <script src="../js/userstable.js"></script>
</body>

</html>