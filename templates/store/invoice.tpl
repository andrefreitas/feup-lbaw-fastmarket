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
             <div class="title">Invoice</div> 
             <span class="number"><b>Number</b>  #fJ89g983g</span><br/>
             <span class="date"><b>Date</b>  22/20/1992</span>
             <!-- Items -->
             <table class="table table-striped cart" id="invoiceItems">
    			 <tr>
    			     <th>#</th>
    			     <th>Name</th>
    			     <th>Unit Price</th>
    			     <th>Quantity</th>
    			     <th>Total</th>
    			 </tr>
    		     {foreach from=$items item=product}
    			     <tr>
    			     <td>{$product.id}</td>
    			     <td>{$product.name}</td>
    			     <td>{$product.price} &euro;</td>
    			     <td>{$product.quantity}</td>
    			     <td>{$product.quantity * $product.price } &euro;</td>
    			     </tr>
    		     {/foreach}
            </table>
    </div>
 </body>
 </html>