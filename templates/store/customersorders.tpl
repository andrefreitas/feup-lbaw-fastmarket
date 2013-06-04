{include file='store/header.tpl'}

<div class="bodyContainer">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
			    <!--  Categories  -->
				<ul class="nav nav-list">
					<li class="nav-header">Categories</li>
					{foreach from=$categories item=category}
					    <li><a href="category.php?store={$storeDomain}&categoryid={$category.id}">{$category.name}</a></li>
                    {/foreach}
                    
                    {if $userPermission == "merchant"}
                    	<li><a href="outstock.php?store={$storeDomain}">Out of stock / removed</a></li>
                    {/if}
				</ul>
			</div>
			{if $userPermission == "merchant"}
			<div class="span_account span10">
			    <!-- Orders -->
			    <table class="table table-striped ">
    			 <tr>
    			     <th>Customer</th>
    			     <th>Date</th>
    			     <th>Total</th>
    			     <th>Status</th>
    			     
    			 </tr>
			     {foreach from=$ordersInfo item=orderInfo}
    			     <tr>
    			     <td>{$orderInfo.name}</td>
    			     <td>{$orderInfo.order_date}</td>
    			     <td>{$orderInfo.total} &euro;</td>
    			     <td>{$orderInfo.paid}</td>
    			     </tr>
			     {/foreach}
                 </table>
			    
			</div>
			 {/if}
		</div>
		
	</div>
</div>

{include file='store/footer.tpl'}