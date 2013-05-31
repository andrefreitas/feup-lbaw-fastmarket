$(document).ready(function(){
	
	/***************************************
	 ************ Handle Events ************
	 ***************************************/
	
	/* E01 - When a user clicks the register button */
	$("#registerButton").click(function(){
		handleUserRegister();
	});
	
	/* Login */
	$("#login").click(function(){
		handleUserLogin();
	});
	

	/* Rating */
	$('#star').raty({
		  score: function() {
		    return $(this).attr('data-score');
		  }
		});

	
	/* Logout */
	$("#logout").click(function(){
		handleUserLogout();
	});
	
	/* makeFavorite */
	$("#makeFavorite").click(function(){
		handleMakeFavorite();
	});

});

/**
 * Handles a user new favorite
 */
function handleMakeFavorite()
{
	var	storeId = $("#registerForm #storeId").val();
	var	productId = $("#productId").val();
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/addFavorite.php?",{
        productId: productId,
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	var res = $.parseJSON(data["responseText"])["result"];
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


function setLogedInState()
{
	/*TODO ... mostrar gravatar, nome...*/
	var storeDomain = $("#registerForm #storeDomain").val();
	window.location="http://gnomo.fe.up.pt/~lbaw12503/fm/pages/store/index.php?store="+storeDomain;
	/*
	$(".login").css("display","none"); 
	$(".login").css("visibility","hidden");
	alert("Login ok");
	*/
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
