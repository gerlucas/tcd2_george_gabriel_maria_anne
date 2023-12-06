<?php
require_once dirname(__DIR__) . '/classes/util.class.php';

if (Util::isLogado()) {
    $perfil = isset($_SESSION['perfil']) ? $_SESSION['perfil'] : null;
    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

?>

    <header class="header">
        <nav class="nav container">
            <div class="nav__data">
                <a href="/tcd2_george_gabriel_maria_anne/index.php" class="nav__logo">
                    <i class="uil uil-restaurant"></i> Restaurante
                </a>

                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line nav__toggle-menu"></i>
                    <i class="ri-close-line nav__toggle-close"></i>
                </div>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li>
                        <a href="/tcd2_george_gabriel_maria_anne/index.php" class="nav__link">Página Inicial</a>
                    </li>
                    <li>
                        <a href="/tcd2_george_gabriel_maria_anne/pages/cardapio.php" class="nav__link">Cardápio</a>
                    </li>
                    <?php if (Util::isPerfilPermitido($perfil, ['Administrador', 'Caixa'])) { ?>
                        <li class="dropdown__item">
                            <div class="nav__link dropdown__button">
                                Caixa <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                            </div>

                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="uil uil-clipboard"></i>
                                        </div>

                                        <span class="dropdown__title">Cadastro</span>

                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/caixa/index.php" class="dropdown__link">Cadastrar Vendas</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="uil uil-search"></i>
                                        </div>

                                        <span class="dropdown__title">Consulta</span>

                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/caixa/listausuarios.php" class="dropdown__link">Consultar Clientes com Débito</a>
                                            </li>
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/caixa/historicoconsumo.php" class="dropdown__link">Consultar Histórico de Consumo</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if (Util::isPerfilPermitido($perfil, ['Administrador', 'Gerente'])) { ?>
                        <li class="dropdown__item">
                            <div class="nav__link dropdown__button">
                                Administração <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                            </div>

                            <div class="dropdown__container">
                                <div class="dropdown__content">
                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="uil uil-file-edit-alt"></i>
                                        </div>

                                        <span class="dropdown__title">Cadastro</span>

                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/admin/index.php" class="dropdown__link">Página de Administração</a>
                                            </li>
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/admin/cadastrousuarios.php" class="dropdown__link">Cadastrar Usuários</a>
                                            </li>
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/admin/cadastroprodutos.php" class="dropdown__link">Cadastrar Produtos</a>
                                            </li>
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/admin/cadastronoticias.php" class="dropdown__link">Escrever Noticias</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="dropdown__group">
                                        <div class="dropdown__icon">
                                            <i class="uil uil-search"></i>
                                        </div>

                                        <span class="dropdown__title">Consulta</span>

                                        <ul class="dropdown__list">
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/admin/listausuarios.php" class="dropdown__link">Consultar Usuários</a>
                                            </li>
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/caixa/listausuarios.php" class="dropdown__link">Consultar Clientes com Débito</a>
                                            </li>
                                            <li>
                                                <a href="/tcd2_george_gabriel_maria_anne/caixa/historicoconsumo.php" class="dropdown__link">Consultar Histórico de Consumo</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <?php } ?>

                    <div class="action">
                        <div class="profile" onclick="menuToggle();">
                            <i class="uil uil-user"></i>
                        </div>

                        <div class="menu">
                            <h3>
                                <?php echo isset($usuario['nome']) ? $usuario['nome'] : 'Nome do Usuário'; ?>
                                <div>
                                    <?php echo isset($perfil) ? $perfil : 'Cargo do Usuário'; ?>
                                </div>

                            </h3>
                            <ul>
                                <li>
                                    <p><?php echo isset($usuario['email']) ? $usuario['email'] : 'Email do Usuário'; ?></p>
                                </li>
                                <li>
                                    <p>PIN: <?php echo isset($usuario['pin']) ? $usuario['pin'] : 'PIN do Usuário'; ?></p>
                                </li>

                                <li>
                                    <a href="/tcd2_george_gabriel_maria_anne/logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </ul>
            </div>
        </nav>
    </header>

<?php
} else {
?>
    <header class="header">
        <nav class="nav container">
            <div class="nav__data">
                <a href="/tcd2_george_gabriel_maria_anne/index.php" class="nav__logo">
                    <i class="uil uil-restaurant"></i> Restaurante
                </a>

                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line nav__toggle-menu"></i>
                    <i class="ri-close-line nav__toggle-close"></i>
                </div>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li>
                        <a href="/tcd2_george_gabriel_maria_anne/index.php" class="nav__link">Página Inicial</a>
                    </li>
                    <li>
                        <a href="/tcd2_george_gabriel_maria_anne/pages/cardapio.php" class="nav__link">Cardápio</a>
                    </li>
                    <li>
                        <a href="/tcd2_george_gabriel_maria_anne/pages/login.php" class="nav__link">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<?php
}
?>