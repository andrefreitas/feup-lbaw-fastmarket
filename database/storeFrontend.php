<?php
if(isset($_SERVER['HTTP_HOST']) and  $_SERVER['HTTP_HOST'] == 'gnomo.fe.up.pt')
    require_once('/opt/lbaw/lbaw12503/public_html/fastmarket/common/database.php');
else{
    $documentRoot = $_SERVER["DOCUMENT_ROOT"];
    if($_SERVER["DOCUMENT_ROOT"] == ""){
        $documentRoot = "/home/andre/git";
    }
    require_once($documentRoot .'/fastmarket/common/database.php');
}


function getStoreProducts($storeId, $limit){
    $sql = "SELECT products.id, products.name, products.description, products.base_cost AS price, "
         . "categories.name AS category, files.path AS file "
         . "FROM products,categories,files "
         . "WHERE products.category_id = categories.id AND categories.store_id = ? "
         . "AND files.id = products.image_id "
         . "ORDER BY insertion_date DESC "
         . "LIMIT ?";
    return query($sql, array($storeId, $limit)); 
}
?>