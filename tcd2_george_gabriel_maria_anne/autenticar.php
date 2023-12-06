<?php

require_once 'classes/autoloader.class.php';

if (isset($_GET['email']) && isset($_GET['senha'])) {
    Util::autenticarUsuario($_GET['email'], $_GET['senha']);

}else{
    header('Location:./pages/login.php');
}
