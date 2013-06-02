<?php
require_once(dirname(__FILE__) . '/configuration.php');
chdir('../lib/Smarty');
include_once('Smarty.class.php');
chdir('../../common');

$smarty = new Smarty;
$smarty->setTemplateDir($BASE_PATH . "templates/");
$smarty->setCompileDir($BASE_PATH . "templates_c/");
?>