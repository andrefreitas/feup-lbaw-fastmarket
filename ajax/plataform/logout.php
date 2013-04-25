<?php
	 require_once('../common/init.php');
     require_once('../database/plataform.php');
     header('Content-type: application/json');
     
     session_destroy();
     
     
     echo json_encode(Array("result"=>"ok"));
?>