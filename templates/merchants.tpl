{include file='header.tpl'}
    <div id="content">
        <div class="container">
            <h2>Merchants</h2>
            Here you can manage all the merchants that exists in the plataform.
            
            <table class="dataview">
               <thead>
                   <tr>
                       <td> Name </td>
                       <td> Email </td>
                       <td> Registration Date </td>
                   <tr>
               </thead>
               {foreach from=$merchants item=merchant}
               <tr>
    		       <td> {$merchant.name} </td>
    		       <td> {$merchant.email} </td>
    		       <td> {$merchant.registration_date} </td>
    	       </tr>   
               {/foreach}
            </table>

        </div>
    </div>
{include file='footer.tpl'}
