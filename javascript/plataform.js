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
		if(registrationIsValid(name,email,password,passwordCheck))
			addMerchant(name, email, password);
		else{
			alert("Invalid data");
		}
	});
});

/*
 * Adds a new merchant
 */
function addMerchant(name, email, password){
	$.getJSON("../ajax/add_merchant.php?",{
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
	var emailRegex= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; 
	return ( password1.length > 0) & ( password1.length > 0) & ( password1 == password2 ) & ( name.length > 1 ) & emailRegex.test(email);
}
