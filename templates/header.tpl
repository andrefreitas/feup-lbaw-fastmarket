<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.10.0/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="{$BASE_URL}/css/plataform.css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="{$BASE_URL}/javascript/crypt.js"></script>
        <script src="{$BASE_URL}/javascript/plataform.js"></script>
        <meta charset="UTF-8" />
    </head>
    <body>
        <header>        
            <div class="container">
                <div class="logo">
                    <a href="index.php"><img src="../images/logo_dark.png" /></a>
                </div>
                {if $loggedin}
                <div class="loggedin">
                    <script> 
                        var avatar = getGravatar("{$smarty.session.email}");
                        document.write('<img class="avatar" src="'+avatar+'" width="60" height="60" />');
                    </script>
                    <div class="userinfo">
                        <b>{$smarty.session.name}</b><br/>
                        <span class="permission">{$smarty.session.permission}</span>
                    </div>
                     <button type="button" name="logout">Logout</button>
                </div>
                
                {else}
                <div class="login">
                    <form>
                        <input type="email" name="email" placeholder="email..."/>
                        <input type="password" name="password" placeholder="password..."/>
                        <button type="button" name="login">Login</button>
                        <button type="button" name="register" onclick="window.location.href='register.php'" >Register</button>
                    </form>
                </div>
                {/if}
                
                
            </div>
        </header>
        {if $loggedin}
        <nav>
            
        </nav>
        {/if}
  