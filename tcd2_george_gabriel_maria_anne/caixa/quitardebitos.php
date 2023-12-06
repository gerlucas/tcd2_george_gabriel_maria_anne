<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/usuarioservices.class.php';

Util::validarAcesso(['Administrador', 'Gerente', 'Caixa']);

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = R::load('usuarios', $id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipo_pagamento']) && isset($_POST['parcial'])) {
        $tipoPagamento = $_POST['tipo_pagamento'];
        $valor = $_POST['parcial'];

        if ($tipoPagamento === 'integral') {
            UsuarioServices::quitarDebito($usuario, $usuario->debito);
        } elseif ($tipoPagamento === 'parcial' && is_numeric($valor) && $valor > 0) {
            UsuarioServices::quitarDebito($usuario, $valor);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/navbar.css">

    <title>WebDev - Restaurante</title>
</head>

<body>

    <?php include '../components/header.component.php' ?>
    <main>
        <form method="post" action="">
            <select name="tipo_pagamento" id="tipo_pagamento" onchange="mostrarInputDebito()">
                <option value="integral">Integral</option>
                <option value="parcial">Parcial</option>
            </select>

            <div id="checkboxDiv" style="display: none;">
                <label for="parcial">Valor a ser quitado: </label>
                <input type="number" id="parcial" name="parcial">
            </div>

            <button type="submit">Pagar Débito</button>
        </form>
    </main>
    <?php include '../components/footer.component.php' ?>

    <script src="../js/navbar.js"></script>
    <script src="../js/cadastroform.js"></script>
</body>

</html>
