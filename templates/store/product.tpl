{include file='store/header.tpl'}

<div class="bodyContainer">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
			    <!--  Categories  -->
				<ul class="nav nav-list">
					<li class="nav-header">Categories</li>
					{foreach from=$categories item=category}
					    <li><a href="#">{$category.name}</a></li>
                    {/foreach}
				</ul>
			</div>
			<div class="span10">
		    <!-- Product -->
		    <h1>{$product.name}</h1>
		    {$product.description}<br>
		    {$product.score}<br>
		    {$product.base_cost * $vat}
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
