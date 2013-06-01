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
			    {$userInfo.email}<br>
			    <form>
			    	New password: <input type="password" name="pass1"></input><br>
			    	
			    	<button type="submit" name="submitPass" class="btn">Submit</button>
			    </form>
			    
			</div>
		</div>
		
	</div>
</div>

{include file='store/footer.tpl'}