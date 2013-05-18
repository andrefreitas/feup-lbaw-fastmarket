{include file='header.tpl'}
    <h1> Merchants </h1>
    <div class="tiles merchants">
        {foreach from=$merchants item=merchant}
            <div class="tile">
                <span class="name"> {$merchant.name} </span>
                <span class="email"> <b>email </b> {$merchant.email} </span>
                <span class="registrationDate">  <b>date</b> {$merchant.registration_date} </span>
                <div class="actions"></div>
            </div>
        {/foreach}
    </div>
{include file='footer.tpl'}