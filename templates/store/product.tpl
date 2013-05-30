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
		    <h1>{$product.name} </h1>   
		    <!--  -->
		    <img src="{$product.file}" class="img-polaroid">
		    <div class="productInfo">
    		    <div class="description"> {$product.description}</div>
    		   
    		    <span class="price">&euro; {$price}</span>
		    </div> 
		    <!--  -->
		    <div class="subProduct">
		        <div id="star" data-score="{$product.score}"></div>
		        <button class="btn btn-inverse" href="#"><i class="icon-shopping-cart icon-white"></i> Add Item to cart</button>
		        <button class="btn" href="#"><i class="icon-star"></i> Make Favorite</button>
		    </div>
		    <!--  -->
		    <h3>Comments <button class="btn" id="addComment"><i class="icon-pencil"></i> Comment</button></h3>
		    <div class="product_comments">
		    {foreach from=$comments item=comment}
		    	<div class="comment">
		    	   <div class="tab">
    		    	   <span class="author"> {$comment.name} </span>
    		    	   <span class="date"> {$comment.comment_date} </span>
		    	   </div>
		   
		    	   <span class="body"> {$comment.body} </span><br>
		    	
		    		
		    	</div>
		    {/foreach}
		    </div>
		    
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
