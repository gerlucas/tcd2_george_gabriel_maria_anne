<?php

class Util
{

    public static function logout()
    {
        if (!isset($_SESSION)) session_start();
        session_destroy();
        header('Location:../tcd2_george_gabriel_maria_anne/index.php');
        die();
    }

    public static function isLogado()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['usuario']);
    }

    public static function validarAcesso($perfisPermitidos = [])
    {
        session_start();

        if (isset($_SESSION['usuario'])) {
            $perfilUsuarioLogado = $_SESSION['perfil'];

            if (!empty($perfisPermitidos) && !in_array($perfilUsuarioLogado, $perfisPermitidos)) {
                header('Location:../index.php?erro=sem_permissao');
                echo '<h1>Você não tem permissão para acessar esta página. Redirecionando...</h1>';
                die();
            }
        } else {
            header('Location:../pages/login.php?erro=sem_autenticacao');
            echo '<h1>Você não está logado. Tente novamente em 3 segundos.</h1>';
            die();
        }
    }

    public static function autenticarUsuario($email, $senha)
    {
        require_once 'classes/autoloader.class.php';

        R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

        $usuario = R::findOne('usuarios', 'email = ? and senha = ?', [$email, md5($senha . '___')]);
        if (isset($usuario)) {
            session_start();
            $_SESSION['usuario'] = [
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'pin' => $usuario->pin
            ];

            $perfis = $usuario->sharedPerfilList;

            foreach ($perfis as $perfil) {
                if ($perfil->nome === 'Administrador') {
                    header('Location:./admin/index.php');
                } else if ($perfil->nome === 'Gerente') {
                    header('Location:./admin/index.php');
                } else if ($perfil->nome === 'Caixa') {
                    header('Location:./index.php');
                } else if ($perfil->nome === 'Cliente') {
                    header('Location:./index.php');
                }
            }

            $_SESSION['perfil'] = $perfil->nome;
        } else {
            header('Location:./pages/login.php?erro=dados_incorretos');
            echo '<h1>Dados incorretos. Tente novamente em 5 segundos.</h1>';
        }

        R::close();
    }

    public static function cadastrarVenda($tipoVenda, $produtoId, $identificacao = null, $comCliente = false)
    {
        date_default_timezone_set('America/Fortaleza');

        $produto = R::load('produtos', $produtoId);
        if (!$produto->id) {
            return 'Produto não encontrado!';
        }

        $venda = R::dispense('vendas');
        $venda->tipo = $tipoVenda;
        $venda->produto = $produto;
        $venda->data = date('Y-m-d H:i:s');

        if ($tipoVenda === 'carteira' && $identificacao) {
            $cliente = R::findOne('usuarios', 'pin = ?', [$identificacao]);

            if ($cliente && $cliente->ativo && $cliente->carteira) {
                $venda->cliente_id = $cliente->id;
                $venda->valor = $produto->preco;
                $idVenda = R::store($venda);
                $cliente->debito += $produto->preco;
                R::store($cliente);

                return 'Venda cadastrada com sucesso!';
            } elseif (!$cliente) {
                return 'Cliente não encontrado!';
            } elseif (!$cliente->ativo) {
                return 'Cliente não está ativo. Não é possível realizar a venda em carteira.';
            } elseif (!$cliente->carteira) {
                return 'A carteira do cliente não está ativa. Não é possível realizar a venda em carteira.';
            }
        } elseif ($tipoVenda === 'a_vista') {
            if ($comCliente && $identificacao) {
                $cliente = R::findOne('usuarios', 'pin = ?', [$identificacao]);

                if ($cliente && $cliente->ativo && $cliente->carteira) {
                    $venda->cliente_id = $cliente->id;
                    $venda->valor = $produto->preco;
                    $idVenda = R::store($venda);
                    R::store($venda);

                    return 'Venda à vista cadastrada com sucesso!';
                } elseif (!$cliente) {
                    return 'Cliente não encontrado!';
                } elseif (!$cliente->ativo) {
                    return 'Cliente não está ativo. Não é possível realizar a venda à vista.';
                } elseif (!$cliente->carteira) {
                    return 'A carteira do cliente não está ativa. Não é possível realizar a venda à vista.';
                }
            } else {
                $venda->valor = $produto->preco;
                $idVenda = R::store($venda);

                return 'Venda à vista cadastrada com sucesso!';
            }
        } else {
            return 'Tipo de venda não reconhecido!';
        }
    }

    public static function isPerfilPermitido($perfil, $permitidos)
    {
        return in_array($perfil, $permitidos);
    }
}
