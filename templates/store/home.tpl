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
				<!--  New Registration -->
			
			</div>
			<div class="span10">
				<!--Body content-->
				{foreach from=$products item=product}
					    <img src="..." class="img-polaroid">
                {/foreach}
			</div>
		</div>
	</div>
</div>

{include file='store/footer.tpl'}
