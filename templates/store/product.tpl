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
			</div>
			<div class="span10">
		    <!-- Product -->
		    
		    <input type="hidden" id="productId" value="{$productId}">
		    <h1>{$product.name} </h1>   
		    <!--  -->
		    <img src="{$product.file}" class="img-polaroid">
		    <div class="productInfo">
    		    <div class="description"> {$product.description}</div>
    		    <input type="hidden" id="productId" value="{$product.id}"/>
    		    <span class="price">&euro; {$price}</span>
		    </div> 
		    <!--  -->
		    <div class="subProduct">
		        <div id="star" data-score="{$product.score}"></div>
		        <button class="btn btn-inverse" href="#"><i class="icon-shopping-cart icon-white"></i> Add to cart</button>
		        <button class="btn" id="makeFavorite" href="#"><i class="icon-star"></i> Make Favorite</button>
		        <button class="btn" id="subscribe"><i class="icon-bookmark"></i> Subscribe</button>
		        <button class="btn" id="addComment"><i class="icon-pencil"></i> Comment</button>
		        <a href="#commentModal" role="button" class="icon-pencil"
						data-toggle="modal">Comment</a>
		    </div>
		    <!--  -->
		    <h3>Comments</h3>
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
