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
        <div class="actions"></div>
    </div>
    {/foreach}    
</div>
{include file='footer.tpl'}