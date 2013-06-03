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
		    <!-- Product -->
		    
		    <input type="hidden" id="productId" value="{$productId}">
		    <h1>{$product.name} {if $isFavorite}<span class="label label-warning"> Favorite </span>{/if} {if $isSubscribed} <span class="label label-info"> Subscribed </span>{/if}</h1>   
		    <!--  -->
		    <img src="{$product.file}" class="img-polaroid fixedProductImage">
		    <div class="productInfo">
    		    <div class="description"> {$product.description}</div>
    		    <input type="hidden" id="productId" value="{$product.id}"/>
    		    <span class="price">&euro; {$price}</span>
		    </div> 
		    <!--  -->
		    <div class="subProduct">
		        <div id="star" data-score="{$product.score}"></div>
		        <button class="btn btn-inverse" href="#" id="addToCart"><i class="icon-shopping-cart icon-white"></i> Add to cart</button>
		        {if !$isFavorite}
		        <button class="btn" id="makeFavorite" href="#"><i class="icon-star"></i> Make Favorite</button>
		        {else}
		        <button class="btn" id="removeFavorite" href="#"><i class="icon-star"></i> Remove Favorite</button>
		        {/if}
		        
		        {if !$isSubscribed}
		        <button class="btn" id="subscribe"><i class="icon-bookmark"></i> Subscribe</button>
		        {else}
		         <button class="btn" id="unsubscribe"><i class="icon-bookmark"></i> Unsubscribe</button>
		        {/if}
		        
		        {if $userPermission == "merchant"}
		        <button class="btn" id="editProduct"> Edit </button>
		        <button class="btn" id="removeProduct"> Remove </button>
		        {/if}
		    </div>
		    <!--  -->
		    <div id="productNotifications"></div>
	
		    <!--  -->
		    <h3>Comments</h3>
		    {if $isLoggedIn}
		    <div id="addCommentForm">
		         <textarea rows="3" ></textarea>
		         <button class="btn btn-mini" type="button" id="addComment">Add Comment</button>
		    </div>
		    {else}
		    <div class="alert alert-info"> You must login to comment </div>
		    {/if}
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

<!-- Modal for editing product info -->
	<div id="editModal" class="modal hide fade register" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">×</button>
			<h3 id="myModalLabel">Edit Product</h3>
		</div>
		<div class="modal-body">
			<!--  Body -->
		    <div class="editNotification">
		    </div>
			<form id="editForm">
				Name: <input type="text" value="{$product.name}" id="editProductName"><br>
				Description: <input type="text" value="{$product.description}" id="editProductDescription"><br>
				Base cost: <input type="text" value="{$product.price}" id="editProductCost"><br>
				Stock: <input type="text" value="{$product.stock}" id="editProductStock"><br>
				Category: <input type="text" value="{$product.category}" id="editProductCategory"><br>
				New Image: <input type="text" value="" id="editProductImage">
				
	        </form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" id="editButton" >Save</button>
		</div>
	</div>

<!-- Modal for comment -->
	<div id="commentModal" class="modal hide fade register" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">×</button>
			<h3 id="myModalLabel">Comment</h3>
		</div>
		<div class="modal-body">
			<!--  Body -->
		    <div class="commentNotification">
		    </div>
			<form id="commentForm">
	            <textarea id="commentText">
	            
	            </textarea>
	        </form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" id="commentButton" >Submit</button>
		</div>
	</div>

{include file='store/footer.tpl'}
