<?php
require_once '../classes/util.class.php';
require_once '../classes/r.class.php';
require_once '../classes/autoloader.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipo_venda']) && isset($_POST['produto'])) {
        $tipoVenda = $_POST['tipo_venda'];
        $produtoId = $_POST['produto'];
        $identificacao = isset($_POST['identificacao']) ? $_POST['identificacao'] : null;
        $comCliente = isset($_POST['com_cliente']) && $_POST['com_cliente'] === 'on';

        $mensagem = Util::cadastrarVenda($tipoVenda, $produtoId, $identificacao, $comCliente);
        echo $mensagem;
    }
}

$produtos = R::findAll('produtos');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebDev - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/loginform.css">
</head>

<body>
    <main>
        <div class="container" id="container">
            <div class="form-container login">
                <form method="POST" action="">
                    <h1>Cadastro</h1>
                    <span>Adicione os dados da venda</span>
                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] === 'email_duplicado') {
                        echo '<p style="color: red;">E-mail já cadastrado. Por favor, escolha outro.</p>';
                    }
                    ?>
                    <select name="tipo_venda" id="tipo_venda" onchange="mostrarInput()">
                        <option value="a_vista">À Vista</option>
                        <option value="carteira">Carteira</option>
                    </select>
                    <label for="com_cliente">Com Cliente:</label>
                    <input type="checkbox" name="com_cliente" id="com_cliente" onchange="mostrarCheckboxCliente()">
                    <div id="checkboxDiv" style="display: none;">
                        <input type="text" name="identificacao" placeholder="PIN" id="identificacao">
                    </div>
                    <select name="produto" id="produto">
                        <?php foreach ($produtos as $produto) : ?>
                            <option value="<?php echo $produto->id; ?>"><?php echo $produto->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button>Cadastrar</button>
                    <a class="link paginicial" href="../index.php">Página Inicial</a>
                </form>
            </div>
            <div class="container-info">
                <div class="info">
                    <div class="info-panel info-right">
                        <h2>Realize o cadastro de um novo produto</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.component.php' ?>
    <script src="../js/navbar.js"></script>
    <script src="../js/cadastroform.js"></script>
</body>

</html>