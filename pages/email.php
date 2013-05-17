<?php
chdir('../common');
require_once('init.php');

$smarty->assign('user',"Pedro Soares");
$smarty->assign('hash',"8yf9t7g923t");
$smarty->display('emails/confirmationEmail.tpl');

?>