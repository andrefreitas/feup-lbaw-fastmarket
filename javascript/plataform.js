/* Plataform Javascript */
$(document).ready(function(){
	
	
	/* Confirm registration fade in */
	$(".confirmRegistration").fadeIn(500);
	
	/* Register dialog box */
	$(".message button").click(function() {
		$('#registerDialog').reveal();
		$('.registerNotification').html('');
	});
	
	/* Register event */
	$(".registration button[name='register']").click( function(){
		$('.registerNotification').html('');
		var data = $(".registration form").serializeArray(),
		    name = data[0]["value"],
		    email = data[1]["value"],
		    password = data[2]["value"],
		    passwordCheck = data[3]["value"];
		
		// Ajax request
		if(registrationIsValid(name,email,password,passwordCheck)){
			password =  CryptoJS.SHA256(password).toString();
			if(addMerchant(name, email, password))
				$('.registerNotification').html('<div class="confirmation"> Check your email</div>');
			else
				$('.registerNotification').html('<div class="error"> User already exists!</div>');
		}
		else{
			$('.error').effect( "bounce", {times:3}, 300 );
		}
	});
	
	/* Merchants */
	$('.merchants .item').hover(function(){
		var actions = ' <span class="edit">Edit</span><span class="delete">Delete</span>';
		$(this).children(".actions").html(actions);
		
		/* Delete Actions */
		$('.merchants .item .actions .delete').click(function(){
			var email = $(this).parent().parent().children(".email").text();
			if (confirm('Are you sure you want to delete ' + email + '?')) {
			    if(deleteMerchant(email)){
			    	var item = $(this).parent().parent();
			    	$(item).fadeOut(500, function(){$(item).remove(); });
			    }
			}
		});
		
		/* Edit Actions */
		$('.merchants .item .actions .edit').click(function(){
			var name = $(this).parent().parent().children(".name").text();
			var email = $(this).parent().parent().children(".email").text();
			$('#editMerchantDialog').reveal();
			$('.editMerchant input[name="oldEmail"]').val(email);
			$('.editMerchant input[name="name"]').val(name);
			$('.editMerchant input[name="email"]').val(email);
		});
	}		
	,function(){
		$(this).children(".actions").html("");
	});
	
	
	
});

/*
 * Adds a new merchant
 */
function addMerchant(name, email, password){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/addMerchant.php?",{
		name: name,
        email: email,
        password: password
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"] == 'ok' ;
}

function deleteMerchant(email){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/deleteMerchant.php?",{
        email: email
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"] == 'ok' ;
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
		$('.registerNotification').html('<div class="error"> Please write your name</div>');
		
	}
	else if(!emailRegex.test(email)){
		$('.registerNotification').html('<div class="error"> Invalid email!</div>');
	} 
	else if(password1.length<1){
		$('.registerNotification').html('<div class="error"> Please write a password</div>');
	
	}else if(password1 != password2){
		$('.registerNotification').html('<div class="error"> Passwords don\'t match!</div>');
	}
	
	return ( password1.length > 0) & ( password1.length > 0) & ( password1 == password2 ) & ( name.length > 1 ) & emailRegex.test(email);
}

/*
* Login
*/
function login(email, password){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/login.php?",{
        email: email,
        password: password
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"] =="ok";
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

/*
* Validate login
*/

function validateLogin(){
	$('.notifications').html("");
	var data = $(".loginbox form").serializeArray(),
		email = data[0]["value"],
		password = data[1]["value"];
	if(email.length == 0 || password.length == 0 || !login(email, password)){

		$('.notifications').html("<div class='error'>Invalid Login!</div>");
		$(".error").effect( "bounce", 
	            {times:3}, 300 );
	}else{
		return true;
	}
	
	return false;
}