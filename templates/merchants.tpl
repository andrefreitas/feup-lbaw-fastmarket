{include file='header.tpl'}
<div class="headBox merchantsBox">
    Filter by status: 
    <select name="status">
        <option value="any" selected="selected">Any</option>
        <option value="active">Active</option>
        <option value="pending">Pending</option>
    </select>
    <span class="search">
        Search: <input type="text" placeholder="keywords"/><button></button>
    </span>
    <button id="addMerchant">Add Merchant</button>
    <span class="total">{$total} merchants</span>
</div>

<div class="merchants">
    {foreach from=$merchants item=merchant}
    <div class="item">
        <span class="name">{$merchant.name}</span>
        <span class="email">{$merchant.email}</span>
        <span class="registrationDate"> {$merchant.registration_date} </span>
        <span class="status"> {$merchant.status} </span>
        <div class="actions"></div>
    </div>
    {/foreach}
</div>
    <div id="editMerchantDialog" class="reveal-modal edit">
        <h1>Edit merchant</h1>
        <div class="editMerchant">
            <div class="notifications">
            </div>
            <form>
                <input name="oldEmail" type="hidden"/>
                <input type="text" name="name" placeholder="name..."/><br/>
                <select name="status">
                   <option value="active">Active</option>
                   <option value="pending">Pending</option>
                </select>
                <input type="email" name="email" placeholder="email..."/><br/>
                <input type="password" name="password" placeholder="password"/><br/>
                <button type="button" name="save">Save changes</button>
            </form>
        </div>
        <a class="close-reveal-modal">&#215;</a>
        </div>
        
    <div id="addMerchantDialog" class="reveal-modal register ">
			<h1>Add Merchant</h1>
			<div class="registration">
    			<form>
                    <div class="registerNotification"></div>
                    <input type="text" name="name" placeholder="name..."/><br/>
                    <input type="email" name="email" placeholder="email..."/><br/>
                    <input type="password" name="password" placeholder="password"/><br/>
                    <input type="password" name="password_check" placeholder="confirm password"/><br/>
                    <button type="button" name="register">Add Merchant</button>
                </form>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>
{include file='footer.tpl'}