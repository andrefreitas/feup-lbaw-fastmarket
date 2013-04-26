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
		}
		else{
			alert("Invalid data");
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
		if(data["result"]=="ok"){
			window.location = "index.php";
		}
	});
}

/*
 * Check registration
 */

function registrationIsValid(name,email,password1,password2){
	var emailRegex= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; 
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