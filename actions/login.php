<?php
chdir('../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET['email']) and isset($_GET['password'])) {
    $password = hash('sha256',$_GET['password']);
    $id = login($_GET['email'], $password);
    if ($id==true) {
        $user=getUserByEmail($_GET['email']);
        $_SESSION['id'] = $user['id'];
        $_SESSION['permission'] = $user['privilege'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        header("Location: ../pages/index.php");
    } 
}
?>