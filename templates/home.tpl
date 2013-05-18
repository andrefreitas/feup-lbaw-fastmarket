<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Fastmarket</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.10.0/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="../css/plataform.css"/>
        <link rel="stylesheet" type="text/css" href="../css/reveal.css"/>
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
        <script src="../javascript/jquery.reveal.js"></script>
        <script src="../javascript/crypt.js"></script>
        <script src="../javascript/plataform.js"></script>
    </head>
    <body>
        <div class="head">
        </div>
        <div class="header">
            <div class="container">
                <img src="../images/logo_white.png" alt="fastmarket" class="whitelogo"/>
                <img src="../images/stores.png" alt="stores" class="stores"/>
                <div class="message">
                    <h1>Want to sell online?</h1>
                    <span class="answer">you are in the right place!</span>
                    <button type="button" name="register" data-reveal-id="registerDialog">Register now!</button>
                </div>
            </div>
        </div>
        <div class="loginbox">
            <form>
                <input type="email" name="email" placeholder="email"/>
                <input type="password" name="password" placeholder="password"/>
                <button type="button" name="login" class="orange">Login</button>
            </form>
        </div>
        <div class="whiteblock">
            <div class="container">
                <div class="block">
                     <img src="../images/feature-simple.png" alt="simple"/>
                     <div class="info">
                         <h2>Simple to use</h2>You don't need to be an expert in Web development, so you can create a store in a click of a button.
                     </div>
                </div>
                 <div class="block">
                     <img src="../images/feature-billing.png" alt="simple"/>
                     <div class="info">
                         <h2>Billing system</h2>We know you need to track your expenses so we have a complete builtin billing manager for you :)
                     </div>
                </div>
             </div>
        </div>
        <div class="blueblock">
                    <div class="container">
                <div class="block">
                     <img src="../images/feature-comments.png" alt="simple"/>
                     <div class="info">
                         <h2>Costumers have voice</h2>Your costumers can comment the products and you can answer them to help in anything they need.
                         
                     </div>
                </div>
                 <div class="block">
                     <img src="../images/feature-score.png" alt="simple"/>
                     <div class="info">
                         <h2>Spread the love</h2>People can rate the products and spread the love for the good they buy, so everybody gets happy!
                     </div>
                </div>
             </div>
        </div>
        <div class="footer">
        Faculdade de Engenharia da Universidade do Porto | Database and Web Applications Laboratory<br/>
        <b>Master in Computers Engineering</b>
        </div>
        <div id="registerDialog" class="reveal-modal">
			<h1>Merchant registration</h1>
			<p>This is a default modal in all its glory, but any of the styles here can easily be changed in the CSS.</p>
			<a class="close-reveal-modal">&#215;</a>
		</div>
    </body>
</html>