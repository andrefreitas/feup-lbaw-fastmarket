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
			<div class="span_account span10">
			    <!-- Orders -->
			    
			    {if $userPermission == "merchant"}
				    <div id="customersOrders">
				    	<span class="itemName">Customer</span> 
				    		<span class="itemDate">Date</span>
				    		<span class="itemPaid">State</span>  
				    		<span class="itemTotal">Total</span> <br>
				    	{foreach from=$ordersInfo item=orderInfo}
				    		<span class="itemName">{$orderInfo.name}</span> 
				    		<span class="itemDate">{$orderInfo.order_date}</span>
				    		<span class="itemPaid">{$orderInfo.paid}</span>  
				    		<span class="itemTotal">{$orderInfo.total}</span> <br>
				    	{/foreach}
				    </div>
			    {/if}
			</div>
		</div>
		
	</div>
</div>

{include file='store/footer.tpl'}