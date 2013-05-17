{include file='header.tpl'}
                {if isset($welcome) and $welcome eq 0} 
                 <div class="error">
                     Invalid registration key!
                 </div>
                {/if}
                {if isset($welcome) and $welcome eq 1} 
                 <div class="confirmation">
                  Your registration has been confirmed :) 
                 </div>
                {/if}  
    <div id="content">
        <div class="container">
            <div class="feature">
                <div class="left">
                    <h1>Create your store!</h1>
                    Fastmarket is a web application that allows you to create a store
                    in easy steps even if you are not a HTML expert. We have a complete billing system.<br/>
                   <button type="button" name="register" onclick="window.location.href='register.php'">Register now!</button>
                </div>
                <div class="right">
                    <img src="../images/store.jpg">
                </div>
            </div>
        </div>
    </div>
{include file='footer.tpl'}
