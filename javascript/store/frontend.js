$(document).ready(function() {

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
	
	$("#updateAccount").click(function() {
		updateAccount();
	});

});

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
		window.location= "account.php?store=" + storeDomain + "&fail";
		
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
	requestSubscribe(productId, userId);
	document.location.reload(true);
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
	//requestAddToCart(storeId, productId);
	$("#productNotifications").html('<div class="alert alert-success">Product added to cart </div>');
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