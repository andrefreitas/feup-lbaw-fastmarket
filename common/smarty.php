<?php
    require_once(dirname(__FILE__) . '/configuration.php');
    include_once($BASE_PATH . 'lib/Smarty/Smarty.class.php');
    
    $smarty = new Smarty;
    $smarty->setTemplateDir($BASE_PATH . "templates/");    
    $smarty->setCompileDir($BASE_PATH . "templates_c/");
?>