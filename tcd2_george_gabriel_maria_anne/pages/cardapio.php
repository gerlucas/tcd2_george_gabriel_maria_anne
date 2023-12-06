<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');
$produtos = R::findAll('produtos');

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
        <h2>Cardapio</h2>
        <h1 class="mcd-category__title--main">Cardápio</h1>
        <div class="container">
            <?php foreach ($produtos as $produto) { ?>
                <div class="card">
                    <div class="icon">
                        <img src="../admin/images/mercearias.png" alt="">
                    </div>
                    <div class="fundo">
                        <h2><?= $produto->nome ?></h2>
                        <h3>Preço: R$ <?= $produto->preco ?></h3>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="colum_menu"></div>
    </main>

    <footer>
        <h2><a class="link paginicial" href="..\/index.php">Página Inicial</a></h2>
        <div class='line'></div>
        <h3>Desenvolvido por: George Lucas, Gabriel Soares, Maria Fernanda e Anne Tayná &copy;</h3>
    </footer>
    <button id="button-to-top" onclick="scrollTopFunction()">
        <span class="arrow"></span>
        Voltar<br>ao Topo
    </button>
    <script src="../js/navbar.js"></script>

    <script>
        function scrollTopFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            var buttonToTop = document.getElementById("button-to-top");
            if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
                buttonToTop.style.display = "block";
            } else {
                buttonToTop.style.display = "none";
            }

        }
    </script>
</body>

</html>