<?php
require_once './classes/util.class.php';
require_once './classes/r.class.php';
require_once './classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');
$noticias = R::findAll('noticias');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebDev - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/cards_noticias.css">
    <link rel="stylesheet" href="./styles/slider.css">
</head>

<body>
    <?php include './components/header.component.php' ?>
    <main>
        <?php
        if (isset($_GET['erro']) && $_GET['erro'] === 'sem_permissao') {
            echo '<p style="color: red; text-align: center; margin-top: 40px;">Você não tem permissão para acessar essa página.</p>';
        }
        ?>
        <section class="container">
            <div class="slider-wrapper">
                <div class="slider">
                    <img id="slide-1" src="https://images.unsplash.com/photo-1590947132387-155cc02f3212?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                    <img id="slide-2" src="https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                    <img id="slide-3" src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                </div>
                <div class="slider-nav">
                    <a href="#slide-1"></a>
                    <a href="#slide-2"></a>
                    <a href="#slide-3"></a>
                </div>
            </div>
        </section>
        <section class="cards">
            <?php foreach ($noticias as $noticia) : ?>
                <section class="card primario">
                    <h3><?php echo $noticia->nome; ?></h3>
                    <span><?php echo $noticia->conteudo; ?></span>
                    <span>Escrito por <strong><?php echo $noticia->autor; ?></strong></span>
                    <span><?php echo $noticia->dataCadastro; ?></span>
                </section>
            <?php endforeach; ?>
    </main>

    <?php include './components/footer.component.php' ?>
    <script src="./js/navbar.js"></script>
</body>

</html>