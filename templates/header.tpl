<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.10.0/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="{$BASE_URL}/css/plataform.css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="{$BASE_URL}/javascript/sha256.js"></script>
        <script src="{$BASE_URL}/javascript/plataform.js"></script>
    </head>
    <body>
        <header>        
            <div class="container">
                <div class="logo">
                    <a href="index.php"><img src="../images/logo_dark.png" /></a>
                </div>
                {if $loggedin}
                lulz
                {else}
                <div class="login">
                    <form>
                        <input type="text" name="email" placeholder="email..."/>
                        <input type="password" name="password" placeholder="password..."/>
                        <button type="button" name="login">Login</button>
                        <button type="button" name="register" onclick="window.location.href='register.php'" >Register</button>
                    </form>
                </div>
                {/if}
                
                
            </div>
        </header>
  