{include file='header.tpl'}
<div class="headBox storesBox">
   
    <span class="search">
        Search: <input type="text" placeholder="keywords"/><button>Search</button>
    </span>
    <button id="addStore">Add Store</button>
    <span class="total">{$total} stores</span>
</div>

<div class="stores">
    {foreach from=$stores item=store}
    <div class="item">
    	<span class="id">{$store.id}</span>
        <span class="name">{$store.name}</span>
        <span class="slogan">{$store.slogan}</span>
        <span class="vat">{$store.vat}</span>
        <span class="domain">{$store.domain}</span>
        <span class="registrationDate"> {$store.creation_date} </span>
        <div class="actions"></div>
    </div>
    {/foreach}
</div>
    <div id="editStoreDialog" class="reveal-modal edit">
        <h1>Edit store</h1>
        <div class="editStore">
            <div class="notifications">
            </div>
            <form>
                 <input type="text" name="id" class="id" placeholder=""/><br/>
                <input type="text" name="name" placeholder="name..."/><br/>
                <input type="text" name="slogan" placeholder="slogan..."/><br/>
                <input type="text" name="vat" placeholder="vat..."/><br/>
                <input type="text" name="domain" placeholder="domain..."/><br/>
                <button type="button" name="save">Save changes</button>
            </form>
        </div>
        <a class="close-reveal-modal">&#215;</a>
        </div>
        
    <div id="addStoreDialog" class="reveal-modal register">
			<h1>Add Store</h1>
			<div class="registrationStore">
    			<form>
                    <div class="registerNotification"></div>
                    <input type="text" name="name" placeholder="name..."/><br/>
                    <input type="text" name="slogan" placeholder="slogan..."/><br/>
                    <input type="text" name="vat" placeholder="vat..."/><br/>
                    <input type="text" name="domain" placeholder="domain..."/><br/>
                    <button type="button" name="addStore">Add Store</button>
                </form>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
{include file='footer.tpl'}
