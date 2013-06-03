$(document).ready(function() {

	/* Check active page*/
	var linkPage = window.location.href;
	linkPage = String(linkPage);
	var storeHome= $("#storeHome");
	var storeFavorites= $("#storeFavorites");
	var storeCart= $("#storeCart");
	
	if(linkPage.match(/favorites.php/) != null)
	{
		storeHome.attr("class","");
		storeFavorites.attr("class","active");
		storeCart.attr("class","");
	}else if(linkPage.match(/index.php/) != null)
	{
		
		storeHome.attr("class","active");
		storeFavorites.attr("class","");
		storeCart.attr("class","");
	}else if(linkPage.match(/cart.php/) != null)
	{
		storeHome.attr("class","");
		storeFavorites.attr("class","");
		storeCart.attr("class","active");
	}

	/***************************************************************************
	 * *********** Handle Events ************
	 **************************************************************************/

	/* E01 - When a user clicks the register button */
	$("#registerButton").click(function() {
		handleUserRegister();
	});

	/* E02 - Login */
	$("#login").click(function() {
		handleUserLogin();
	});

	/* E03 -Rating */
	$('#star').raty({
		score : function() { return $(this).attr('data-score'); },
		click : function() { handleRating() }
	});


	/* E04 - Logout */
	$("#logout").click(function() {
		handleUserLogout();
	});

	/* E05 - Favorite a product */
	$("#makeFavorite").click(function() {
		handleMakeFavorite();
	});

	/* E06 - Remove Favorite */
	$("#removeFavorite").click(function() {
		handleRemoveFavorite();
	});

	/* E07 - Insert new comment */
	$("#addComment").click(function() {
		handleAddComment();
	});

	/* E08 - Subscribe */
	$("#subscribe").click(function() {
		handleSubscribe();
	});
	
	/* E09 - Subscribe */
	$("#unsubscribe").click(function() {
		handleUnsubscribe();
	});
	
	/* E10 - Add product to cart */
	$("#addToCart").click(function() {
		handleAddToCart();
	});
	
	/* Update Account info*/
	$("#updateAccount").click(function() {
		updateAccount();
	});
	
	/* E11 - Cart item remove */
	$(".cart .remove").click(function(){
		handleCartRemove(this);
	});
	
	/* E12 - Cart item change*/
	$(".cart .change").click(function(){
		handleCartChange(this);
	});
	
	/* E13 - Clear cart */
	$("#clearCart").click(function(){
		handleClearCart();
	});
	
	/* E14 - Checkout */
	$("#checkout").click(function(){
		handleCheckout();
	});
	
	/* E15 - Add Item */
	$(".addItem").click(function(){
		handleAddItem(this);
	});

	/* Add category to store*/
	$("#addCategory").click(function(){
		addCategory();
	});
	
	/* Remove category from store*/
	$("#removeCategory").click(function(){
		removeCategory();
	});
	
	/* Add product to store*/
	$("#addProduct").click(function(){
		addProduct();
	});
	
	/* Remove product from store*/
	$("#removeProduct").click(function(){
		removeProduct();
	});
	
	/* Show Product modal*/
	$("#editProduct").click(function(){
		$("#editModal").modal("show");
	});
	
	/* Edit Product info*/
	$("#editButton").click(function(){
		editProduct();
	});
	
	/* Search button */
	$(".search button").click(function(){
		handleSearch(this);
	});
	
	/* Update Cart total */
	updateCartTotal();
	
	/* View Invoice */
	$(".viewInvoice").click(function(){
		handleViewInvoice(this);
	});
	
});

/*
 * Edit product
 */
function editProduct(){
	var productId=$("#productId").val();
	var name=$("#editProductName").val();
	var description=$("#editProductDescription").val();
	var cost=$("#editProductCost").val();
	var stock=$("#editProductStock").val();
	var category=$("#editProductCategory").val();
	var storeId = getStoreId();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/updateProduct.php?", {
		productId: productId,
		name: name,
		description: description,
		cost: cost,
		stock: stock,
		category: category,
		storeId: storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	var ret = $.parseJSON(data["responseText"])["result"];
	if(ret=="ok")
	{
		var storeDomain = $("#registerForm #storeDomain").val();
		window.location.href= "index.php?store=" + storeDomain;
		
	}else{
		alert("erro: "+ret);
	}
}

/*
 * Remove product from store
 */
function removeProduct(){
	var storeId = getStoreId();
	var productId= $("#productId").val();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/removeProduct.php?", {
		productId: productId,
		storeId: storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	var ret = $.parseJSON(data["responseText"])["result"];
	if(ret=="ok")
	{
		var storeDomain = $("#registerForm #storeDomain").val();
		window.location.href= "index.php?store=" + storeDomain;
		
	}else{
		alert("erro: "+ret);
	}
}

/*
 * Add product to store
 */
function addProduct(){
	var storeId = getStoreId();
	var name = $("#newProductName").val();
	var description = $("#newProductDescription").val();
	var cost = $("#newProductCost").val();
	var stock = $("#newProductStock").val();
	var category = $("#newProductCategory").val();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/addProduct.php?", {
		name: name,
		description: description,
		base_cost: cost,
		stock: stock,
		category: category,
		storeId: storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	

	var ret = $.parseJSON(data["responseText"])["result"];
	if(ret=="ok")
	{
		var storeDomain = $("#registerForm #storeDomain").val();
		window.location.href= "index.php?store=" + storeDomain;
		
	}else{
		alert("erro: "+ret);
	}
}

/*
 * Remove category from store
 */
function removeCategory(){
	var storeId = getStoreId();
	var category = $("#categoryName").val();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/removeCategory.php?", {
		category: category,
		storeId: storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	

	var ret = $.parseJSON(data["responseText"])["result"];
	if(ret=="ok")
	{
		var storeDomain = $("#registerForm #storeDomain").val();
		window.location.href= "account.php?store=" + storeDomain;
		
	}else{
		alert("erro: "+ret);
	}
}

/*
 * Add category to store
 */
function addCategory(){
	var storeId = getStoreId();
	var category = $("#categoryName").val();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/addCategory.php?", {
		category: category,
		storeId: storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	

	var ret = $.parseJSON(data["responseText"])["result"];
	if(ret=="ok")
	{
		var storeDomain = $("#registerForm #storeDomain").val();
		
		window.location.href= "../store/account.php?store=" + storeDomain;
		
		//document.location.reload(true);
	}else{
		alert("erro: "+ret);
	}
}

/*
 * Update Account info
 */
function updateAccount(){
	var userId = $("#AccountId").val();
	var name = $("#newName").val();
	var email = $("#newEmail").val();
	var pass = $("#newPass").val();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/updateAccount.php?", {
		name : name,
		email : email,
		password: pass,
		userId : userId
	});
	$.ajaxSetup({
		"async" : true
	});

	

	var ret = $.parseJSON(data["responseText"])["result"];
	if(ret=="ok")
	{
		var storeDomain = $("#registerForm #storeDomain").val();
		window.location.href= "account.php?store=" + storeDomain;
		
	}else{
		alert("erro: "+ret);
	}
};

/**
 * Handles add comment event
 */
function getCommentText() {
	return $("#addCommentForm textarea").val();
}
function handleAddComment() {
	var text = getCommentText();
	var productId = getProductId();
	var storeId = getStoreId();
	requestAddComment(text, productId, storeId);
	location.reload();
}

/**
 * Request add comment
 */
function requestAddComment(text, productId, storeId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/addComment.php?", {
		text : text,
		productId : productId,
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	return $.parseJSON(data["responseText"])["result"];
}
/**
 * Handles a user registration event
 */

function handleUserRegister() {
	var name = $("#registerForm #name").val();
	var email = $("#registerForm #email").val();
	var password = $("#registerForm #password").val();
	var confirmPassword = $("#registerForm #confirmPassword").val();
	var storeId = $("#registerForm #storeId").val();

	$('.registerNotification').html('');
	if (registrationIsValid(name, email, password, confirmPassword)) {
		var result = requestAddCostumer(name, email, password, storeId);

		if (result == "ok") {
			$('.registerNotification')
					.html(
							'<div class="alert alert-success"> Registration is complete! </div>');
			setTimeout(function() {
				$('#registrationModal').modal('hide');

			}, 1500);
		} else if (result == "userExists") {
			$('.registerNotification')
					.html(
							'<div class="alert alert-error"> Email already in use! </div>');
		}
	}

}
/**
 * Request an add costumer
 */

function requestAddCostumer(name, email, password, storeId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/addCostumer.php?", {
		name : name,
		email : email,
		password : password,
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/**
 * Handles a user login event
 */
function handleUserLogin() {
	var email = $("#login_email").val();
	var password = $("#login_pass").val();
	var storeId = $("#registerForm #storeId").val();
	var result = requestLogin(email, password, storeId);
	$('#userNotification').html("");
	if (result == "invalid") {
		$('#userNotification').html(
				'<div class="alert alert-error">Invalid login !</div>');
	} else if (result == "ok") {
		location.reload();
	}
}

/**
 * Request login
 */

function requestLogin(email, password, storeId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/login.php?", {
		email : email,
		password : password,
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/**
 * Handles a user logout event
 */
function handleUserLogout() {
	var storeDomain = $("#registerForm #storeDomain").val();
	var storeId = $("#registerForm #storeId").val();
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/logout.php?", {
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});

	var result = $.parseJSON(data["responseText"])["result"];
	window.location = "index.php?store=" + storeDomain;
}

/**
 * Validate registration
 */
function registrationIsValid(name, email, password1, password2) {

	var emailRegex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (name.length < 1) {
		$('.registerNotification')
				.html(
						'<div class="alert alert-error"> Please write your name! </div>');

	} else if (!emailRegex.test(email)) {
		$('.registerNotification').html(
				'<div class="alert alert-error"> Invalid email!</div>');
	} else if (password1.length < 1) {
		$('.registerNotification')
				.html(
						'<div class="alert alert-error"> Please write a password!</div>');

	} else if (password1 != password2) {
		$('.registerNotification')
				.html(
						'<div class="alert alert-error"> Passwords don\'t match!</div>');
	}

	return (password1.length > 0) & (password1.length > 0)
			& (password1 == password2) & (name.length > 1)
			& emailRegex.test(email);
}

/**
 * Get session
 */

function getSession() {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/getSession.php?");
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"]);
}

/**
 * Is logged in
 */

function isLoggedIn() {
	if (getSession().hasOwnProperty("storesLogin")) {
		var stores = getSession()["storesLogin"];
		var storeId = getStoreId();
		return (stores.hasOwnProperty(storeId))
				&& stores[storeId]["userId"] != null;
	}
	return false;
}

/**
 * Get store Id
 */
function getStoreId() {
	return $('.storeId').val();
}

function getStoreDomain() {
	return $('.storeDomain').val();
}

/**
 * Get product id
 */

function getProductId() {
	return $('#productId').val();
}

/**
 * Get session userId
 */
function getUserId() {
	var stores = getSession()["storesLogin"];
	return stores[getStoreId()]["userId"];
}

/**
 * Handle make a favorite
 */
function handleMakeFavorite() {
	if (isLoggedIn()) {
		var productId = getProductId();
		var userId = getUserId();
		requestMakeFavorite(productId, userId);
		document.location.reload(true);
	} else {
		$('#userNotification')
				.html(
						'<div class="alert alert-error">You need to login first </div>');
	}
}

/**
 * Request make favorite
 */
function requestMakeFavorite(productId, userId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/makeFavorite.php?", {
		productId : productId,
		userId : userId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/**
 * Request remove favorite
 */
function requestRemoveFavorite(productId, userId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/removeFavorite.php?", {
		productId : productId,
		userId : userId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/* Handle remove favorite */
function handleRemoveFavorite() {
	var productId = getProductId();
	var userId = getUserId();
	requestRemoveFavorite(productId, userId);
	document.location.reload(true);
}

/* Handle subscription */
function handleSubscribe() {
	var productId = getProductId();
	var userId = getUserId();
	if(isLoggedIn()){
		requestSubscribe(productId, userId);
		document.location.reload(true);
	} else {
		$('#userNotification')
		.html(
				'<div class="alert alert-error">You need to login first </div>');
	}
}

/* Request subscribe */
function requestSubscribe(productId, userId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/subscribe.php?", {
		productId : productId,
		userId : userId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/* Handles unsubscribe */
function handleUnsubscribe() {
	var productId = getProductId();
	var userId = getUserId();
	requestUnsubscribe(productId, userId);
	document.location.reload(true);
}

/* Request unsubscribe */
function requestUnsubscribe(productId, userId) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/unsubscribe.php?", {
		productId : productId,
		userId : userId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

function handleRating(){
	if(isLoggedIn()){
		var score = $('#star').raty('score');
		var productId = getProductId();
		var userId = getUserId();
		requestRate(productId, userId, score);
		document.location.reload(true);
	}else{
		$('#userNotification')
		.html(
				'<div class="alert alert-error">You need to login first </div>');
	}
}

function requestRate(productId, userId, score){
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/rate.php?", {
		productId : productId,
		userId : userId,
		score : score
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/** Handle add to cart **/
function handleAddToCart(){
	var productId = getProductId();
	var storeId = getStoreId();
	requestAddToCart(storeId, productId);
	$("#productNotifications").html('<div class="alert alert-success">Product added to cart </div>');
	updateCartTotal();
}

/** Request add to cart **/
function requestAddToCart(storeId, productId){
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/addToCart.php?", {
		productId : productId,
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

function getCartItemId(line){
	return parseInt($(line).parent().parent().children().first().html());
}
function getCartItemQuantity(line){
	return parseInt($(line).parent().parent().children().eq(3).html());
}
/** Remove from cart **/
function requestRemoveFromCart(storeId, productId){
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/removeFromCart.php?", {
		productId : productId,
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}
/** Handle cart remove **/
function handleCartRemove(line){
	var productId = getCartItemId(line);
	var storeId = getStoreId();
	var par = $(line).parent().parent();
	if (confirm('Are you sure you want to delete this item?')) {
		requestRemoveFromCart(storeId, productId);
		$(par).fadeOut(500, function(){document.location.reload(true); });
	} 
	
}

/** Handle cart change **/
function handleCartChange(line){
	var productId = getCartItemId(line);
	var quantity = getCartItemQuantity(line);
	var storeId = getStoreId();
	var newQuantity = prompt("Product quantity", quantity);
	if(newQuantity == 0 ){
		requestRemoveFromCart(storeId, productId);
	}else{
	requestCartChangeQuantity(storeId, productId, newQuantity);
	}
	document.location.reload(true);
}


/** Request cart change quantity **/
function requestCartChangeQuantity(storeId, productId, newQuantity){
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/cartChangeQuantity.php?", {
		productId : productId,
		storeId : storeId,
		quantity : newQuantity
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

/* Clear Cart */
function handleClearCart(){
	if (confirm('Are you sure you want to clear the cart?')) {
	var storeId = getStoreId();
	requestClearCart(storeId);
	document.location.reload(true);
	}
}

function requestClearCart(storeId){
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/clearCart.php?", {
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["result"];
}

function updateCartTotal(){
	var storeId = getStoreId();
	requestUpdateCartTotal(storeId);
}

function requestUpdateCartTotal(storeId){
	$.getJSON("../../ajax/store/getCartTotal.php?",{storeId : storeId}).done(function(data){
		var total = data.total;
		$("#cartTotal").attr("class", "label");
		$("#cartTotal").html(total);
	});
}

function getCartTotal(storeId){
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../../ajax/store/getCartTotal.php?", {
		storeId : storeId
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"])["total"];
}

function handleCheckout(){
	if(isLoggedIn()){
		var storeId = getStoreId();
		var cartTotal = getCartTotal(storeId);
		if(cartTotal>0 && confirm("Are you sure you want to checkout?")){
				window.location = "../../actions/store/checkout.php?storeId="+ storeId;
		} else if(cartTotal == 0){
			alert("Your cart is empty!");
		}
	}else{
		$('#userNotification').html('<div class="alert alert-error">You need to login first </div>');
	}
}

function handleAddItem(item){
	var productId = parseInt($(item).parent().parent().children(".productId").eq(0).attr("value"));
	var storeId = getStoreId();
	if(confirm("Are you sure you want to add this item to cart?")){
		requestAddToCart(storeId, productId);
		requestUpdateCartTotal(storeId);
	}
}

function handleSearch(bt){
	var storeDomain = getStoreDomain();
	var terms = $(bt).parent().children("input").val();
	window.location = "search.php?store=" + storeDomain + "&terms=" +  terms;
}

function handleViewInvoice(bt){
	var orderId = $(bt).parent().parent().children().eq(0).html();
	window.location = "invoice.php?orderId=" + orderId;
}
