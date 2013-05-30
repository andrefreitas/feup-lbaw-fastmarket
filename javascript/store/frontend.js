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
	/* Commit */

	/* Logout */
	$("#logout").click(function(){
		handleUserLogout();
	});

});


/**
 * Handles a user registration event
 */

function handleUserRegister(){
	var	name = $("#registerForm #name").val();
	var	email = $("#registerForm #email").val();
	var	password = $("#registerForm #password").val();
	var	confirmPassword = $("#registerForm #confirmPassword").val();
	var	storeId = $("#registerForm #storeId").val();
	requestAddCostumer(name, email, password, storeId);
	$('#registrationModal').modal('hide');
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
	var pass = $("#login_pass").val();
	var storeId = $("#registerForm #storeId").val();
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/login.php?",{
        email: email,
        password: pass,
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	
	
	var result = $.parseJSON(data["responseText"])["result"];
	
	if(result == "ok")
	{
		
		setLogedInState();
	
	}
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
 function handleUserLogout()
 {
 	var storeDomain = $("#registerForm #storeDomain").val();
 	var storeId = $("#registerForm #storeId").val();
 	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../../ajax/store/logout.php?",{
        storeId: storeId
	});
	$.ajaxSetup( { "async": true } );
	
	
	var result = $.parseJSON(data["responseText"])["result"];
	window.location="http://gnomo.fe.up.pt/~lbaw12503/fm/pages/store/index.php?store="+storeDomain;
 }
