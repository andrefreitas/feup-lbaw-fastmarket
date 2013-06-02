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
			<div class="span_account span10">
			    <!-- Account -->
			    <h1>{$userInfo.name}</h1><br>
			    <input type="hidden" value="{$userInfo.id}" id="AccountId">
			    <form>
			    	Account name: <input type="text" id="newName" value="{$userInfo.name}"><br>
			    	Email: <input type="text" id="newEmail" value="{$userInfo.email}"><br>
			    	New password: <input type="password" value="" id="newPass"><br>
			    	
			    	<button class="btn" id="updateAccount">Update Account</button>
			    </form>
			    <br>
			    {if $userPermission == "merchant"}
				    <div id="merchantTools">
				    	<h1>Merchant Tools</h1><br>
				    	TODO....
				    </div>
			    {/if}
			</div>
		</div>
		
	</div>
</div>

{include file='store/footer.tpl'}