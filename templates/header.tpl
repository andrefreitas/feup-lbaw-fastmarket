<!DOCTYPE html>
<html>
    <head>
        <title>{$title}</title>
        <!--  CSS -->
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.10.0/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="../css/plataform.css"/>
        <link rel="stylesheet" type="text/css" href="../css/reveal.css"/>
        <link rel="stylesheet" type="text/css" href="../css/plataform_backoffice.css"/>
        <!--  Javascript  -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="../javascript/jquery-ui.js"></script>
        <script type="text/javascript" src="../javascript/jquery.reveal.js"></script>
        <script type="text/javascript" src="../javascript/crypt.js"></script>
        <script type="text/javascript" src="../javascript/plataform.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="../javascript/plataform_dashboard.js"></script>
        <!--  Favicon -->
        <link rel="shortcut icon" href="../images/favicon.ico" />
    </head>
    <body>
        <div class="headline"></div>
        <header>
            <div class="container">
                <div class="logo">
                    <a href="administration.php"><img src="../images/logo_white.png" alt="fastmarket"/></a>
                </div>
                <nav>
                    <ul>
                        {if $smarty.session.permission== "admin"}
                        <li><a href="administration.php" class="administration">Administration</a></li>
                        {/if}
                        <li><a href="stores.php" class="stores">Stores</a></li>
                        {if $smarty.session.permission== "admin"}
                        <li><a href="merchants.php" class="merchants">Merchants</a></li>
                        {/if}
                        <li><a href="#" class="account">My Account </a></li>
                    </ul>
                      <div class="userInfo">
                        <span class="permission">{$permission}</span> {$user} <button>Logout</button>
                     </div>
                </nav>
              
            </div>
        </header>
        <div class="container">
            <div id="box">
      