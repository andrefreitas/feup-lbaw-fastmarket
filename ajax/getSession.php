<?php
chdir("../common");
require_once("init.php");
echo json_encode($_SESSION);
?>