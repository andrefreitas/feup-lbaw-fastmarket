{include file='header.tpl'}
<div class="dashboard">
    <div class="title">Administration Dashboard</div>
    
    <div class="row">
        <!-- New shops Widget -->
        <div class="widget medium" id="newShops">
            <h2>New Shops by month</h2>
            <div class="content">
             <div id="chart_newShops"></div>
            </div>
        </div>
        
         <!-- Last Merchants -->
        <div class="widget big" id="lastMerchants">
            <h2>Last Merchants</h2>
            <div class="content">
                    {foreach from=$lastMerchants item=merchant}
                    <div class="merchant">
                        <span class="name">{$merchant.name}</span>
                        <span class="email">{$merchant.email}</span>
                        <span class="registrationDate"> {$merchant.registration_date} </span>
                        <span class="status"> {$merchant.status} </span>
                    </div>
                    {/foreach}
            </div>
        </div>
    </div>
    
        <div class="row">
        <!-- Top Shops by sales -->
        <div class="widget medium" id="topShops">
            <h2> Top 3 Shops by sales</h2>
            <div class="content">
            {foreach from=$storesProfits item=store}
                    <div class="store">
                        <span class="domain">{$store.domain}</span>
                        <span class="profit">{$store.profit} &euro;</span>
                    </div>
            {/foreach}
            </div>
        </div>
        
         <!-- Last Shops thumbnails -->
        <div class="widget big" id="lastStores">
            <h2>Last Stores</h2>
            <div class="content">
            {foreach from=$storesLogos item=logo}
                    <div class="store">
                      <img src="{$logo.file}"/>
                      <span class="domain">
                          {$logo.domain}
                      </span>
                    </div>
            {/foreach}
            </div>
        </div>
    </div>
    
</div>
{include file='footer.tpl'}