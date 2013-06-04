{include file='store/header.tpl'}

<div class="bodyContainer">
        <div class="container-fluid">
                <div class="row-fluid">
                        <div class="span2">
                            <!--  Categories  -->
                                <ul class="nav nav-list">
                                        <li class="nav-header">Categories</li>
                                        {foreach from=$categories item=category}
                                            <li><a href="category.php?store={$storeDomain}&categoryid={$category.id}">{$category.name}</a></li>
                    {/foreach}
                    
                    {if $userPermission == "merchant"}
                        <li><a href="outstock.php?store={$storeDomain}">Out of stock / removed</a></li>
                    {/if}
                                </ul>
                        </div>
                        {if $userPermission == "merchant"}
                        <div class="span_account span10">
                            <!-- Orders -->
                            <table class="table table-striped ">
                         <tr>
                             <th>#</th>
                             <th>Customer</th>
                             <th>Date</th>
                             <th>Total</th>
                             <th>Status</th>
                             <th>Actions</th>
                             
                         </tr>
                         {$totalPaid=0}
                             {foreach from=$ordersInfo item=orderInfo}
                             <tr>
                             <td>{$orderInfo.id}</td>
                             <td>{$orderInfo.name}</td>
                             <td>{$orderInfo.order_date|date_format:'%Y-%m-%d %H:%M:%S'}</td>
                             <td>{$orderInfo.total} &euro;</td>
                             <td>{if $orderInfo.paid}{$totalPaid = $totalPaid + $orderInfo.total}<span class="label label-success">Paid</span> 
                                 {else} <span class="label label-warning">Pending</span> {/if}</td>
                             <td><button class="btn viewInvoice btn-small"><i class="icon-list-alt"></i> View Invoice </button></td>
                             </tr>
                             
                             {/foreach}
                 </table>
                 <br>
                 <h2>Total paid: {$totalPaid} &euro;</h2>
                            
                        </div>
                         {/if}
                </div>
                
        </div>
</div>

{include file='store/footer.tpl'}