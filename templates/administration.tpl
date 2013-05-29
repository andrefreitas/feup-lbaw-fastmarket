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
            <h2> Top Shops by sales</h2>
            <div class="content">
            
            </div>
        </div>
        
         <!-- Last Shops thumbnails -->
        <div class="widget big" id="lastShops">
            <h2>Last Shops</h2>
            <div class="content">
            
            </div>
        </div>
    </div>
    
</div>
{include file='footer.tpl'}