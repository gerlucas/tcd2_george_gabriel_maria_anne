<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');
if (Util::isLogado()) {
    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../styles/cards_cardapio.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <title>WebDev - Restaurante</title>
</head>

<body>
    <?php include '../components/header.component.php' ?>

    <main>
        <?php
        if ($usuario && isset($usuario['nome'], $usuario['email'])) {
            echo 'Nome: ' . $usuario['nome'] . '<br>';
            echo 'Email: ' . $usuario['email'] . '<br>';
        } else {
            echo "Usuário não logado";
        }
        ?>
    </main>

    <script src="../js/navbar.js"></script>

</body>

</html>