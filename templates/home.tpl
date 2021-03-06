<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Fastmarket</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.10.0/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="../css/plataform.css"/>
        <link rel="stylesheet" type="text/css" href="../css/reveal.css"/>
        <link rel="shortcut icon" href="../images/favicon.ico" />
      
       
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
         <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
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
                {if isset($welcome) and $welcome eq 1} 
                     <div class="confirmRegistration">
                      Registration done!
                     </div>
                {else}
                 <img src="../images/stores.png" alt="stores" class="stores"/>
                <div class="message">
                    <h1>Want to sell online?</h1>
                    <span class="answer">you are in the right place!</span>
                    <button type="button" name="register" data-reveal-id="registerDialog">Register now!</button>
          
                </div>
                
                {/if} 
               
            </div>
        </div>
        <div class="loginbox">
             <div class="container">
                <form action="../actions/login.php" onsubmit="return validateLogin()">
                    <input type="email" name="email" placeholder="email"/>
                    <input type="password" name="password" placeholder="password"/>
                    <input type="submit" value="Login" class="orange"/>
                </form>
                <div class="notifications">
                </div>
              </div>
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
        <div id="registerDialog" class="reveal-modal register ">
			<h1>New registration</h1>
			<div class="registration">
    			<form>
                    <div class="registerNotification"></div>
                    <input type="text" name="name" placeholder="name..."/><br/>
                    <input type="email" name="email" placeholder="email..."/><br/>
                    <input type="password" name="password" placeholder="password"/><br/>
                    <input type="password" name="password_check" placeholder="confirm password"/><br/>
                    <button type="button" name="register">Register now!</button>
                </form>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
    </body>
</html>