<?php
class UsuarioServices
{
    public static function salvarUsuario($nome, $email, $senha, $perfilform, $carteira, $pin)
    {
        date_default_timezone_set('America/Fortaleza');

        require_once '../classes/r.class.php';
        require_once '../classes/autoloader.class.php';

        R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

        $emailExistente = R::findOne('usuarios', 'email = ?', [$email]);
        $pinExistente = R::findOne('usuarios', 'pin = ?', [$pin]);

        if ($emailExistente) {
            header('Location:../admin/cadastrousuarios.php?erro=email_duplicado');
            exit();
        }
        if($pinExistente){
            header('Location:../admin/cadastrousuarios.php?erro=pin_duplicado');
            exit();
        }

        $u = R::dispense('usuarios');
        $u->nome = $nome;
        $u->email = $email;
        $u->senha = md5($senha . '___');
        $u->ativo = true;
        $u->carteira = $carteira;
        $u->pin = $pin;

        $perfil = R::findOne('perfil', 'nome = ?', [$perfilform]);
        $u->sharedPerfilList = [$perfil];
        $u->dataCadastro = date('d/m/Y H:i:s');
        $u->dataEdicao = date('0/0/0 0:0:0');

        R::store($u);
        R::close();

        header('Location:../index.php');
    }


    public static function editarUsuario($id, $nome, $perfilform, $email, $ativo, $carteira, $debito)
    {
        date_default_timezone_set('America/Fortaleza');

        require_once '../classes/r.class.php';
        require_once '../classes/autoloader.class.php';

        $u = R::load('usuarios', $id);

        $u->nome = $nome;
        $u->email = $email;
        $u->ativo = $ativo;
        $u->carteira = $carteira;
        $u->debito = $debito;

        $perfil = R::findOne('perfil', 'nome = ?', [$perfilform]);

        if (!$perfil) {
            $perfil = R::dispense('perfil');
            $perfil->nome = $perfilform;
            R::store($perfil);
        }

        $u->xownPerfilList = [];
        $u->sharedPerfilList = [$perfil];

        $u->dataEdicao = date('d/m/Y H:i:s');

        R::store($u);
        R::close();
    }

    public static function salvarProduto($nome, $preco, $descricao)
    {
        require_once '../classes/r.class.php';
        require_once '../classes/autoloader.class.php';

        R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

        $p = R::dispense('produtos');
        $p->nome = $nome;
        $p->preco = $preco;
        $p->descricao = $descricao;
        $p->dataCadastro = date('d/m/Y H:i:s');

        R::store($p);
        R::close();
    }

    public static function salvarNoticia($nome, $autor, $conteudo)
    {
        date_default_timezone_set('America/Fortaleza');
    
        require_once '../classes/r.class.php';
        require_once '../classes/autoloader.class.php';
    
        R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');
    
        $n = R::dispense('noticias');
        $n->nome = $nome;
        $n->conteudo = $conteudo;
        $n->autor = $autor;
        $n->dataCadastro = date('d/m/Y H:i:s');
        R::store($n);
        R::close();
    }
    

    public static function localizarTodos()
    {
        require_once '../classes/r.class.php';

        R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

        $usuarios = R::findAll('usuarios');

        R::close();

        return $usuarios;
    }

    public static function quitarDebito($usuario, $valor) {
        if ($valor <= 0) {
            echo 'O valor do pagamento deve ser maior que zero.';
            return;
        }
    
        if ($valor > $usuario->debito) {
            $usuario->debito = 0;
        } else {
            $usuario->debito -= $valor;
        }
    
        R::store($usuario);
        R::close();
    }
    
}
