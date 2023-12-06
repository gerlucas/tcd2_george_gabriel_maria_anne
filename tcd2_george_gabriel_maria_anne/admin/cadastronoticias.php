<?php
require_once '../classes/util.class.php';
require_once '../classes/usuarioservices.class.php';

Util::validarAcesso(['Administrador', 'Gerente']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'], $_POST['autor'], $_POST['conteudo'])) {
        $nome = $_POST['nome'];
        $autor = $_POST['autor'];
        $conteudo = $_POST['conteudo'];

        UsuarioServices::salvarNoticia($nome, $autor, $conteudo);
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/991va4po2085mutlze47ld9an9og51nxnier3f1rps867rcv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>
    <main>
        <div class="container" id="container">
            <div class="form-container login">
                <form method="post" action="">
                    <script>
                        tinymce.init({
                            selector: 'textarea',
                            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                            menubar: false,
                            tinycomments_mode: 'embedded',
                            tinycomments_author: 'Author name',
                            mergetags_list: [{
                                    value: 'First.Name',
                                    title: 'First Name'
                                },
                                {
                                    value: 'Email',
                                    title: 'Email'
                                },
                            ],
                            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                            width: '100%',
                            height: '250px'
                        });
                    </script>
                    <h1>Cadastro</h1>
                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] === 'email_duplicado') {
                        echo '<p style="color: red;">E-mail já cadastrado. Por favor, escolha outro.</p>';
                    }
                    ?>
                    <span>Adicione as informações da notícia</span>
                    <input type="text" name="nome" placeholder="Título" id="nome" required>
                    <input type="text" name="autor" placeholder="Autor" id="autor" required>
                    <textarea name="conteudo" placeholder="Conteúdo da notícia"></textarea>
                
            </div>
            <div class="container-info">
                <div class="info">
                    <div class="info-panel info-right">
                        <h2>Adicione as informações e escreva uma nova notícia</h2>
                        <button class="right">Cadastrar</button>
                        <a class="link paginicial right" href="../index.php">Página Inicial</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </main>
</body>

</html>