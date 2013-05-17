/* Plataform Javascript */
$(document).ready(function(){
	
	/* Register event */
	$(".registration button[name='register']").click( function(){
		var data = $(".registration form").serializeArray(),
		    name = data[0]["value"],
		    email = data[1]["value"],
		    password = data[2]["value"],
		    passwordCheck = data[3]["value"];
		
		// Ajax request
		if(registrationIsValid(name,email,password,passwordCheck)){
			password =  CryptoJS.SHA256(password).toString();
			addMerchant(name, email, password);
			$('.nameNotification').html('<div class="confirmation"> Check your email</div>');
		}
		else{
			$('.error').effect( "bounce", {times:3}, 300 );
		}
	});
	
	/* Login Event */
	$(".login button[name='login']").click( function(){
		var data = $(".login form").serializeArray(),
	    email = data[0]["value"],
	    password = data[1]["value"];
		login(email, password);
		
	});
	
	/* Logout Event */
	$(".loggedin button[name='logout']").click( function(){
		console.log("logout");
		logout();
	});
	
});

/*
 * Adds a new merchant
 */
function addMerchant(name, email, password){
	$.getJSON("../ajax/plataform/addMerchant.php?",{
		name: name,
        email: email,
        password: password
	},
    function(data){
		console.log(data);
		
	});
}

/*
 * Check registration
 */

function registrationIsValid(name,email,password1,password2){
	$('.nameNotification').html('');
	$('.emailNotification').html('');
	$('.passwordNotification').html('');
	var emailRegex= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; 
	if(name.length<1){
		$('.nameNotification').html('<div class="error"> Please write your name</div>');
		
	}
	else if(!emailRegex.test(email)){
		$('.emailNotification').html('<div class="error"> Invalid email!</div>');
	} 
	else if(password1.length<1){
		$('.passwordNotification').html('<div class="error"> Please write a password</div>');
	
	}else if(password1 != password2){
		$('.passwordNotification').html('<div class="error"> Passwords don\'t match!</div>');
	}
	
	return ( password1.length > 0) & ( password1.length > 0) & ( password1 == password2 ) & ( name.length > 1 ) & emailRegex.test(email);
}

/*
* Login
*/
function login(email, password){
	password =  CryptoJS.SHA256(password).toString();
	$.getJSON("../ajax/plataform/login.php?",{
        email: email,
        password: password
	},
    function(data){
		console.log(data);
		location.reload();
	});
}

/*
* Logout
*/
function logout(){
	$.getJSON("../ajax/plataform/logout.php",{}, function(){
		location.reload();
	});
}

/*
* Get gravatar
*/
function getGravatar(email){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/getGravatar.php?",{
		email: email,
        default: "http://gnomo.fe.up.pt/~lbaw12503/fastmarket/images/default-avatar.png",
        size: 70
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["url"];
}