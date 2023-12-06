<?php
require_once '../classes/util.class.php';

Util::validarAcesso(['Administrador', 'Gerente']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/cards_admin_index.css">
    
    <title>WebDev - Restaurante</title>
</head>

<body>
    <?php include '../components/header.component.php' ?>
    <main>
        <section class="cards">
            <section class="card primario">
                <div class="icon">
                    <i class="uil uil-file-minus-alt"></i>
                </div>
                <h3>Cadastrar Usuarios</h3>
                <span>Acesse abaixo o formulário para cadastro de usuários.</span>
                <button><a href="../admin/cadastrousuarios.php">Cadastrar Usuario</a></button>
            </section>
            <section class="card secundario">
                <div class="icon">
                    <i class="uil uil-box"></i>
                </div>
                <h3>Cadastrar Produtos</h3>
                <span>Acesse abaixo o formulário para cadastro de produtos.</span>
                <button><a href="../admin/cadastroprodutos.php">Cadastrar Produtos</a></button>
            </section>
            <section class="card terciario">
                <div class="icon">
                    <i class="uil uil-file"></i>
                </div>
                <h3>Escrever Noticias</h3>
                <span>Acesse abaixo o formulário para escrever uma notícia.</span>
                <button><a href="../admin/cadastronoticias.php">Criar Noticias</a></button>
            </section>
            <section class="card primario">
                <div class="icon">
                    <i class="uil uil-search-alt"></i>
                </div>
                <h3>Consultar Usuarios</h3>
                <span>Acesse abaixo a tabela para consulta de usuários.</span>
                <button><a href="../admin/listausuarios.php">Consultar Usuarios</a></button>
            </section>

    </main>
    <?php include '../components/footer.component.php' ?>
    <script src="../js/navbar.js"></script>

</body>

</html>