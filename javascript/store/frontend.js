$(document).ready(function(){
	
	/***************************************
	 ************ Handle Events ************
	 ***************************************/
	
	/* E01 - When a user clicks the register button */
	$("#registerButton").click(function(){
		handleUserRegister();
	});
	
	/* E02 - Login */
	$("#login").click(function(){
		handleUserLogin();
	});
	

	/* E03 -Rating */
	$('#star').raty({
		  score: function() {
		    return $(this).attr('data-score');
		  }
		});

	
	/* E04 -  Logout */
	$("#logout").click(function(){
		handleUserLogout();
	});
	
	/* E05 - Make favorite a product */
	$("#makeFavorite").click(function(){
		handleMakeFavorite();
	});
	
	$("#addComment").click(function(){
		$("#commentModal").modal({
		     keyboard: true,
		     backdrop: 'static'
		 });
		$("#commentText").val('');
	});
	
	$("#commentButton").click(function(){
		handleAddComment();
	});

});


/**
 * Handles add comment event
 */
function handleAddComment(){
	var storeId = $("#registerForm #storeId").val();
	var storeDomain = $("#registerForm #storeDomain").val();
	var text = $("#commentText").val();
	var productId = getProductId();
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/addComment.php?",{
        text: text,
        productId: productId,
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	var res= $.parseJSON(data["responseText"])["result"];
	/*TODO mostrar resultado*/
	window.location="index.php?store="+storeDomain;
}

/**
 * Handles a user registration event
 */

function handleUserRegister(){
	var	name = $("#registerForm #name").val();
	var	email = $("#registerForm #email").val();
	var	password = $("#registerForm #password").val();
	var	confirmPassword = $("#registerForm #confirmPassword").val();
	var	storeId = $("#registerForm #storeId").val();
	
	$('.registerNotification').html('');
	if(registrationIsValid(name,email,password, confirmPassword)){
		var result = requestAddCostumer(name, email, password, storeId);
		
		if(result == "ok"){
			$('.registerNotification').html('<div class="alert alert-success"> Registration is complete! </div>');
			setTimeout(function() {
				$('#registrationModal').modal('hide');
				
			}, 1500);	
		} else if (result == "userExists"){
			$('.registerNotification').html('<div class="alert alert-error"> Email already in use! </div>');
		}
	}
	
	
}
/** 
* Request an add costumer
 */

function requestAddCostumer(name, email, password, storeId){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/addCostumer.php?",{
        name: name,
        email: email,
        password: password,
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"];
}

/**
 * Handles a user login event
 */
function handleUserLogin(){
	var email = $("#login_email").val();
	var password = $("#login_pass").val();
	var storeId = $("#registerForm #storeId").val();
	var result = requestLogin(email, password, storeId);
	$('#userNotification').html("");
	if (result == "invalid") {
		$('#userNotification').html('<div class="alert alert-error">Invalid login !</div>');
	} else if (result == "ok"){
		location.reload();
	}
}

/**
 * Request login
 */

function requestLogin(email, password, storeId){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/login.php?",{
        email: email,
        password: password,
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"];
}


/**
 * Handles a user logout event
 */
 function handleUserLogout(){
 	var storeDomain = $("#registerForm #storeDomain").val();
 	var storeId = $("#registerForm #storeId").val();
 	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/logout.php?",{
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	
	
	var result = $.parseJSON(data["responseText"])["result"];
	window.location="index.php?store="+storeDomain;
 }
 
 /**
  * Validate registration
  */
 function registrationIsValid(name,email,password1,password2){

		var emailRegex= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; 
		if(name.length<1){
			$('.registerNotification').html('<div class="alert alert-error"> Please write your name! </div>');
			
		}
		else if(!emailRegex.test(email)){
			$('.registerNotification').html('<div class="alert alert-error"> Invalid email!</div>');
		} 
		else if(password1.length<1){
			$('.registerNotification').html('<div class="alert alert-error"> Please write a password!</div>');
		
		}else if(password1 != password2){
			$('.registerNotification').html('<div class="alert alert-error"> Passwords don\'t match!</div>');
		}
		
		return ( password1.length > 0) & ( password1.length > 0) & ( password1 == password2 ) & ( name.length > 1 ) & emailRegex.test(email);
	}
 
 
 /** 
  * Get session
  * */

 function getSession(){
 	$.ajaxSetup( { "async": false } );
 	var data = $.getJSON("../../ajax/getSession.php?");
 	$.ajaxSetup( { "async": true } );
 	return $.parseJSON(data["responseText"]);
 }

 /**
  * Is logged in
  */
 
 function isLoggedIn(){
	 if(getSession().hasOwnProperty("storesLogin")){
	 var stores = getSession()["storesLogin"];
	 var storeId = getStoreId();
	 return (stores.hasOwnProperty(storeId)) && stores[storeId]["userId"]!= null;
	 }
	 return false;
 }
 
 /**
  * Get store Id
  */
 function getStoreId(){
	return $('.storeId').val();
 }
 
 /**
  * Get product id
  */
 
 function getProductId(){
	 return $('#productId').val();
 }
 
 /**
  * Get session userId
  */
 function getUserId(){
	 var stores = getSession()["storesLogin"];
	 return stores[getStoreId()]["userId"];
 }
 
 
 /**
 * Handle make a favorite
 */
 function handleMakeFavorite(){
	 if(isLoggedIn()){
		 var productId = getProductId();
		 var userId = getUserId();
		 requestMakeFavorite(productId, userId);
	 }
 }
 

 
 /**
  * Request make favorite
  */
 function requestMakeFavorite(productId, userId){
		$.ajaxSetup( { "async": false } );
		var data = $.getJSON("../../ajax/store/makeFavorite.php?",{
	        productId: productId,
	        userId: userId
		});
		$.ajaxSetup( { "async": true } );
		return $.parseJSON(data["responseText"])["result"];
	}