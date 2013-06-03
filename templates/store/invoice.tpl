<!DOCTYPE html>
<html>
<head>
<title>View Invoice</title>
<!--  CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/store/frontend.css">
    <!--  Javascript  -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../../javascript/jquery-ui.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../lib/raty/jquery.raty.js"></script>
    <script type="text/javascript" src="../../javascript/crypt.js"></script>
    <script type="text/javascript" src="../../javascript/store/frontend.js"></script>

</head>
<body id="invoice">
    <div id="paper">
             <div class="head">
                 <div class="title">Invoice {if $paid} <span class="label label-success">Paid</span> {else} <span class="label label-warning">Unpaid</span> {/if}</div> 
                 <span class="sub"><b>Code</b> # <span id ="invoiceCode">{$invoice.code}</span><br/>
                 <span class="sub"><b>Date</b>  {$order.order_date}</span><br/>
                 <span class="sub"><b>Vat</b>  {$invoice.vat*100} %</span>
             </div>
             <div class="payment">
             <button class="btn btn-inverse" id="payInvoice"> Pay Invoice </button>
             </div>
             <!-- Items -->
             <table class="table table-striped cart" id="invoiceItems">
    			 <tr>
    			     <th>#</th>
    			     <th>Name</th>
    			     <th>Unit Price</th>
    			     <th>Quantity</th>
    			     <th>Total</th>
    			 </tr>
    			 {$total = 0}
    		     {foreach from=$items item=product}
    			     <tr>
    			     <td>{$product.id}</td>
    			     <td>{$product.name}</td>
    			     <td>{$product.price} &euro;</td>
    			     <td>{$product.quantity}</td>
    			     <td>{$product.quantity * $product.price } &euro;</td>
    			     {$total = $total + ($product.quantity * $product.price)}
    			     </tr>
    		     {/foreach}
            </table>
             <div class="total">
            Total : {$total} &euro;
            </div>
            <div class="total">
            Total (VAT) : {$invoice.total} &euro;
            </div>
    </div>
 </body>
 </html>