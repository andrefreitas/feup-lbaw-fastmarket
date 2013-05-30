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
		    &euro; {$product.price}<br>
		    {$price}
		    
		    <div class="product_comments">
		    {foreach from=$comments item=comment}
		    	<div class="comment">
		    		<span class="comment_body"> {$comment.body} </span><br>
		    		<span class="comment_date"> {$comment.DATE} </span><br>
		    		<span class="comment_author"> {$comment.name} </span>
		    	</div>
		    {/foreach}
		    </div>
		    
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
