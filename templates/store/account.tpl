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
			    <!-- Account -->
			    <h1>{$userInfo.name}</h1><br>
			    <input type="hidden" value="{$userInfo.id}" id="AccountId">
			    <table>
			    	<tr>
			    		<td>Account name: </td>
			    		<td><input type="text" id="newName" value="{$userInfo.name}"></td>
			    	</tr>
			    	<tr>
			    		<td>Email: </td>
			    		<td><input type="text" id="newEmail" value="{$userInfo.email}"></td>
			    	</tr>
			    	<tr>
			    		<td>New password: </td>
			    		<td><input type="password" value="" id="newPass"></td>
			    	</tr>
			    </table>	
			    	<button class="btn" id="updateAccount">Update Account</button>
			    
			    <br>
			    {if $userPermission == "merchant"}
				    <div id="merchantTools">
				    <br>
				    	<h1>Merchant Tools</h1><br>
				    	<div>
				    		<button class="btn" onclick="location.href='customersorders.php?store={$storeDomain}'">Customers Orders</button><br>
				    		<br>
				    		<h4>New Category </h4><br>
				    		Category: <input type="text" id="categoryName" value=""><br>
				    		<button class="btn" id="addCategory">Add Category</button>
				    		<button class="btn" id="removeCategory">Remove Category</button><br>
					    	<br>
					    	<h4>New Product</h4>
					    	<br>
					    	<table>
						    	<tr><td>Name: </td>
						    		<td><input type="text" id="newProductName" value=""></td></tr>
						    	<tr><td>Description: </td>
						    		<td><input type="text" id="newProductDescription" value=""></td></tr>
						    	<tr><td>Base Cost: </td>
						    		<td><input type="text" id="newProductCost" value=""></td></tr>
						    	<tr><td>Stock: </td>
						    		<td><input type="text" id="newProductStock" value=""></td></tr>
						    	<tr><td>Category name: </td>
						    		<td><input type="text" id="newProductCategory" value=""></td></tr>
					    	</table>
					    	<button class="btn" id="addProduct">Add Product</button>
					    	
				    	</div>
				    </div>
			    {/if}
			</div>
		</div>
		
	</div>
</div>

{include file='store/footer.tpl'}