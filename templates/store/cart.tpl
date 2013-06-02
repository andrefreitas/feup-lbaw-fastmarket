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
				</ul>
			
			   
			</div>
			<div class="span10">
			 <h2>Cart</h2>
			 <table class="table table-striped">
			 <tr>
			     <th>Name<th>
			     <th>Unit Cost<th>
			     <th>Quantity<th>
			     <th>Sub-total<th>
			 </tr>
			 {foreach from=$cartProducts item=product}
			 <tr>
			     <td>{$product.name}<td>
			     <td>{$product.price} &euro;<td>
			     <td>{$product.quantity}<td>
			     <td>{$product.subtotal} &euro;<td>
			 </tr>
			 {/foreach}

            </table>
            <div class="total">
            <b>Total</b>  {$total} &euro; <br/>
			<b>Total + VAT {$vat * 100} %</b>:  {$totalVat} &euro;
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
