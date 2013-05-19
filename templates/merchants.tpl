{include file='header.tpl'}
<div class="headBox">
    Filter by status: 
    <select id="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    <span class="search">
        Search: <input type="text" placeholder="keywords"/><button></button>
    </span>
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
    <div id="editMerchantDialog" class="reveal-modal edit">
        <h1>Edit merchant</h1>
        <div class="editMerchant">
        <form>
            <input type="text" name="name" placeholder="name..."/><br/>
            <select name="status">
               <option value="active">Active</option>
               <option value="pending">Pending</option>
            </select>
            <input name="oldEmail" type="hidden"/>
            <input type="email" name="email" placeholder="email..."/><br/>
            <input type="password" name="password" placeholder="password"/><br/>
            <input type="password" name="password_check" placeholder="confirm password"/><br/>
            <button type="button" name="save">Save changes</button>
        </form>
        </div>
                <a class="close-reveal-modal">&#215;</a>
        </div>
</div>
{include file='footer.tpl'}