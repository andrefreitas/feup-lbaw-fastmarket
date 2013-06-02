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
				<!--  New Registration -->
			  
			</div>
			<div class="span10">
				<!--Body content-->
			    <table class="table table-striped cart">
    			 <tr>
    			     <th>#</th>
    			     <th>Date</th>
    			     <th>Total</th>
    			     <th>Status</th>
    			     <th>Actions</th>
    			 </tr>
			     {foreach from=$orders item=order}
    			     <tr>
    			     <td>{$order.id}</td>
    			     <td>{$order.date}</td>
    			     <td>{$order.total} &euro;</td>
    			     <td>{if $order.paid} <span class="label label-success">Paid</span> {else} <span class="label label-warning">Pending</span> {/if}</td>
    			     <td><button class="btn viewInvoice btn-small"><i class="icon-list-alt"></i> Invoice </button></td>
    			     </tr>
			     {/foreach}
                 </table>
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}