<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

Util::validarAcesso(['Administrador', 'Gerente', 'Caixa']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = R::load('usuarios', $id);
    $historicoVendas = R::find('vendas', 'cliente_id = ?', [$id]);
}
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
            <h1>Histórico - <?php echo $usuario->nome; ?></h1>
            <a class="link paginicial" style="margin: 0 auto;" href="../index.php">Página Inicial</a>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> ID da Venda <span class="icone"><i class="uil uil-tag"></i></i></span></th>
                        <th> Valor <span class="icone"><i class="uil uil-money-bill"></i></span></th>
                        <th> Data da Venda <span class="icone"><i class="uil uil-calender"></i></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($historicoVendas)) : ?>
                        <?php foreach ($historicoVendas as $venda) : ?>
                            <tr>
                                <td><?php echo $venda->id; ?></td>
                                <td><?php echo 'R$ '.$venda->valor; ?></td>
                                <td><?php echo $venda->data; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="../js/userstable.js"></script>
</body>

</html>