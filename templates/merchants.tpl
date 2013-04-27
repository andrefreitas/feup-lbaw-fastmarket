{include file='header.tpl'}
    <div id="content">
        <div class="container_merchants">
            <table class="merchant">
		<tr>
		<td><span class="merchant_title">Name</span></td>
		<td><span class="merchant_title">Email</span></td>
		<td><span class="merchant_title">Registration Date</span></td>
              </tr>
	     {foreach from=$merchants item=merchant}
            <tr>
		<td><span class="merchant_name">{$merchant.name}</span></td>
		<td><span class="merchant_email">{$merchant.email}</span></td>
		<td><span class="merchant_date">{$merchant.registration_date}</span></td>
	     </tr>
            {/foreach}
           </table>
	</div>
    </div>
{include file='footer.tpl'}
