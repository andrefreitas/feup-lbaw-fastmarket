<?php
/* Outputs the session in raw mode */
require_once(dirname(__FILE__) . '/configuration.php');
session_set_cookie_params (0, $COOKIE_PATH);
session_start();
print_r($_SESSION);
?>