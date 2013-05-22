{include file='header.tpl'}
<div class="headBox">
    Filter by status: 
    <select name="status">
        <option value="any" selected="selected">Any</option>
        <option value="active">Active</option>
        <option value="pending">Pending</option>
    </select>
    <span class="search">
        Search: <input type="text" placeholder="keywords"/><button></button>
    </span>
    <button id="addMerchant">Add Store</button>
    <span class="total">{$total} stores</span>
</div>

<div class="merchants">
    {foreach from=$stores item=store}
    <div class="item">
        <span class="name">{$store.name}</span>
        <span class="email">{$store.slogan}</span>
        <span class="registrationDate"> {$store.creation_date} </span>
        <div class="actions"></div>
    </div>
    {/foreach}
</div>
    <div id="editMerchantDialog" class="reveal-modal edit">
        <h1>Edit store</h1>
        <div class="editMerchant">
            <div class="notifications">
            </div>
            <form>
                
                <input type="text" name="name" placeholder="name..."/><br/>
                <input type="email" name="slogan" placeholder="slogan..."/><br/>
                <input type="text" name="vat" placeholder="vat..."/><br/>
                <input type="text" name="domain" placeholder="domain..."/><br/>
                <button type="button" name="save">Save changes</button>
            </form>
        </div>
        <a class="close-reveal-modal">&#215;</a>
        </div>
        
    <div id="addMerchantDialog" class="reveal-modal register ">
			<h1>Add Store</h1>
			<div class="registration">
    			<form>
                    <div class="registerNotification"></div>
                    <input type="text" name="name" placeholder="name..."/><br/>
                    <input type="email" name="slogan" placeholder="slogan..."/><br/>
                    <input type="text" name="vat" placeholder="vat..."/><br/>
                    <input type="text" name="domain" placeholder="domain..."/><br/>
                    <button type="button" name="register">Add Store</button>
                </form>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
{include file='footer.tpl'}