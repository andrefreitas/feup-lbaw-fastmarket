<?php
chdir("../common");
require_once('database.php');
chdir("../database");
require_once('plataform.php');
chdir("../actions");

if (isset($_GET["hash"])){
    $hash = $_GET["hash"];
    activateUserByHash($hash);
    if(activateUserByHash($hash)){
        header("Location: ../pages/index.php?welcome=1");
    }else{
        header("Location: ../pages/index.php?welcome=0");
    }
}
?>