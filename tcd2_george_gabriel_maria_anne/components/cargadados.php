<?php

require_once '../classes/autoloader.class.php';
require_once '../classes/util.class.php';
require_once '../classes/usuarioservices.class.php';
require_once '../classes/r.class.php';

R::setup('mysql:host=127.0.0.1;dbname=restaurant', 'root', '');

date_default_timezone_set('America/Fortaleza');

$perfiladministrador = R::dispense('perfil');
$perfiladministrador->nome = 'Administrador';
R::store($perfiladministrador);

$perfilgerente = R::dispense('perfil');
$perfilgerente->nome = 'Gerente';
R::store($perfilgerente);

$perfilcaixa = R::dispense('perfil');
$perfilcaixa->nome = 'Caixa';
R::store($perfilcaixa);

$perfilcliente = R::dispense('perfil');
$perfilcliente->nome = 'Cliente';
R::store($perfilcliente);

$u = R::dispense('usuarios');
$u->nome = 'Lucas';
$u->email = 'lucas@gmail.com';
$u->senha = md5('456' . '___');
$u->ativo = true;
$u->carteira = true;
$u->debito = 200;
$u->pin = 1234;
$u->sharedPerfilList = [$perfiladministrador];
$u->dataCadastro = date('d/m/Y H:i:s');
$u->dataEdicao = date('0/0/0 0:0:0');
R::store($u);

$p = R::dispense('produtos');
$p->nome = 'Hambúrguer';
$p->descricao = 'Oi teste.......................';
$p->preco = 14;
$p->dataCadastro = date('d/m/Y H:i:s');
R::store($p);

$p2 = R::dispense('produtos');
$p2->nome = 'Bala Fini';
$p2->descricao = 'Oi teste.......................';
$p2->preco = 3;
$p2->dataCadastro = date('d/m/Y H:i:s');
R::store($p2);

$p3 = R::dispense('produtos');
$p3->nome = 'Pastel';
$p3->descricao = 'Oi teste.......................';
$p3->preco = 5;
$p3->dataCadastro = date('d/m/Y H:i:s');
R::store($p3);


$n = R::dispense('noticias');
$n->nome = 'Black Friday: Delícias Irresistíveis a Preços Exclusivos!';
$n->conteudo = 'Neste dia especial, nossos clientes terão a oportunidade de saborear pratos exclusivos a preços irresistíveis. De entradas deliciosas a sobremesas tentadoras, preparamos um menu especial para tornar sua visita ainda mais memorável. ';
$n->autor = 'Lucas';
$n->dataCadastro = date('d/m/Y H:i:s');

R::store($n);
R::close();
