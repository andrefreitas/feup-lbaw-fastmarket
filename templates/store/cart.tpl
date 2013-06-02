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
			<div class="span10">
			 <h2>Cart</h2>
			 <table class="table table-striped cart">
			 <tr>
			     <th>#</th>
			     <th>Name</th>
			     <th>Unit Cost</th>
			     <th>Quantity</th>
			     <th>Sub-total</th>
			     <th>Actions</th>
			 </tr>
			 {foreach from=$cartProducts item=product}
			 <tr>
			     <td>{$product.id}</td>
			     <td>{$product.name}</td>
			     <td>{$product.price} &euro;</td>
			     <td>{$product.quantity}</td>
			     <td>{$product.subtotal} &euro;</td>
			     <td><i class="icon-remove-sign remove"></i> <i class="icon-plus change"></i></td>
			 </tr>
			 {/foreach}

            </table>
            <div class="total">
            <b>Total</b>  {$totalVat} &euro; <button class="btn btn-inverse" id="checkout"><i class="icon-shopping-cart icon-white"></i> Checkout</button> <button class="btn btn-danger" id="clearCart"><i class="icon-trash icon-white"></i> Clear Cart</button>
			
			</div>
			
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
