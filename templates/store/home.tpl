{include file='store/header.tpl'}

<div class="bodyContainer">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
			    <!--  Categories  -->
				<ul class="nav nav-list">
					<li class="nav-header">Categories</li>
					{foreach from=$categories item=category}
					    <li><a href="http://gnomo.fe.up.pt/~lbaw12503/fm/pages/store/category.php?store={$storeDomain}&categoryid={$category.id}">{$category.name}</a></li>
                    {/foreach}
				</ul>
				<!--  New Registration -->
			
			</div>
			<div class="span10">
				<!--Body content-->
				{foreach from=$products item=product}
				        <div class="productItem">
					        <img src="{$product.file}" >
					        <div class="name"> {$product.name}</div>
					        <div class="description">{$product.description}</div> 
					        <div class="price">{($product.price * (1 + $vat))}  &euro;</div>
					        <div class="actions">
					            <a class="btn" href="#"><i class="icon-shopping-cart"></i> Add Item</a>
					            <a class="btn btn-inverse" href="product.php?store={$storeDomain}&id={$product.id}">View</a>
					        </div>
					    </div>
                {/foreach}
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
