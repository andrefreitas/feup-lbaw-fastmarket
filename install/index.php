<?php
    require_once('../common/database.php');
    if( isset($_GET["auth"]) and $_GET["auth"] == 'nB50vy'){
        $sql = file_get_contents('setup.sql');
        $qr = $db->exec($sql);
        $sql = file_get_contents('examples.sql');
        $qr = $db->exec($sql);
        echo "Installation done sucessfully!";
    }
?>