{include file='header.tpl'}
    <div id="content">
        <div class="container">
            <div class="mercha
            {foreach from=$merchants item=merchant}
            <div class="merchant">{$merchant.name}</div>
            {/foreach}
        </div>
    </div>
{include file='footer.tpl'}
