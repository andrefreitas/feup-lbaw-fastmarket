/* Plataform Javascript */
$(document).ready(function(){
	
	$("a.account").click(function(){
		$('#myAccountDialog').reveal();
	});
	
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
				$('.registerNotification').html('<div class="confirmation"> Confirmation email sent</div>');
			else
				$('.registerNotification').html('<div class="error"> User already exists!</div>');
		}
		else{
			$('.error').effect( "bounce", {times:3}, 300 );
		}
	});
	
	/* Register Store event */
	$(".registrationStore button[name='addStore']").click( function(){
		$('.registerNotification').html('');
		var data = $(".registrationStore form").serializeArray(),
		    name = data[0]["value"],
		    slogan = data[1]["value"],
		    vat = data[2]["value"],
		    domain = data[3]["value"];
		
		// Ajax request
		if(addStoreIsValid(name,slogan,vat,domain)){
			
			if(addStore(name,slogan,vat,domain)){
				var merchantEmail = getSession()["email"];
				addStoreOwner(merchantEmail, domain);
				$('.registerNotification').html('<div class="confirmation"> Store added!</div>');
				$('.registrationStore input').attr('readonly', 'readonly');
			}
			else
				$('.registerNotification').html('<div class="error"> Store already exists!</div>');
		}
		else{
			$('.error').effect( "bounce", {times:3}, 300 );
		}
	});
	
	/**************************************
	 ************** MERCHANTS *************
	 *************************************/
	
	initMerchantsEvents();
	initStoresEvents();
	
	/* Filter merchants by status */
	$('.merchantsBox select').change(function() {
		  var status = $('.merchantsBox select').find(":selected").text().toLowerCase();
		  var searchTerms = $('.search input').val();
		  if(searchTerms!=""){
			  var merchants = searchMerchants(searchTerms);
			  console.log(merchants);
			  merchants = filterMerchantsByStatus(merchants, status);
			  updateMerchantsList(merchants);
		  }else{
			  var merchants = getMerchantsByStatus(status);
			  updateMerchantsList(merchants);
		  }

		
		});

	
	/* Search Merchants */
	$('.merchantsBox .search button').click(function (){
		var status = $('.headBox select[name="status"]').find(":selected").text().toLowerCase();
		var terms = $('.search input').val();
		var merchants = searchMerchants(terms);
		merchants = filterMerchantsByStatus(merchants, status);
		updateMerchantsList(merchants);
	});
	
	/* Search Stores */
	$('.storesBox .search button').click(function (){
		var terms = $('.search input').val();
		var stores = searchStores(terms);
		updateStoresList(stores);
	});
	
	/* Add Merchant */
	$('#addMerchant').click(function(){
		$('#addMerchantDialog').reveal();
	});
	
	/* Add Store */
	$('#addStore').click(function(){
		$('#addStoreDialog').reveal();
	});
	
	/* Logout */
	$('.userInfo button').click(function(){
		logout();
	});

	
	/**************************************
	 ************** Stores ****************
	 *************************************/
	
	
});

/* Filter merchants by a status */
function filterMerchantsByStatus(merchants, status){
	var filteredMerchants = new Array();
	for(var i=0; i<merchants.length;  i++){
		var merchant = merchants[i];
		if(status=="any" || merchant["status"] == status){
			filteredMerchants.push(merchant);
		}
	}
	return filteredMerchants;
}
/*
 * Update merchants list
 */
function updateMerchantsList(merchants){
	  $('#box .merchants').html("");
	  for(var i=0; i<merchants.length;  i++){
		 var merchant = merchants[i];
		 var html = createMerchantItem(merchant["name"], merchant["email"], merchant["registration_date"], merchant["status"]);
		 $('#box .merchants').append(html);
	  }
	  initMerchantsEvents();
	  updateMerchantsTotal(merchants.length);
}
/*
 * Update stores list
 */
function updateStoresList(stores){
	  $('#box .stores').html("");
	  for(var i=0; i<stores.length;  i++){
		 var store = stores[i];
		 var html = createStoreItem(store["id"],store["name"],store["slogan"],store["vat"],store["domain"],store["creation_date"]);
		 $('#box .stores').append(html);
	  }
	  initStoresEvents();
	  updateStoresTotal(stores.length);
}

/*
 * Create merchant item
 */

function createMerchantItem(name, email, date, status){
	var html = '\t<div class="item">\n';
		html += '\t\t<span class="name">' + name + '</span>\n';
		html += '\t\t<span class="email">' + email + '</span>\n';
		html +='\t\t<span class="registrationDate">' + date + ' </span>\n';
		html +='\t\t<span class="status">' + status + '</span>\n';
		html +='\t\t<div class="actions"></div>\n';
		html +='\t</div>';
    return html;
}

/*
 * Create store item
 */

function createStoreItem(id,name, slogan,vat,domain, date){
	var html = '\t<div class="item">\n';
		html += '\t\t<span class="id">' + id + '</span>\n';
		html += '\t\t<span class="name">' + name + '</span>\n';
		html += '\t\t<span class="slogan">' + slogan + '</span>\n';
		html +='\t\t<span class="domain">' + domain + ' </span>\n';
		html +='\t\t<span class="registrationDate">' + date + '</span>\n';
		html +='\t\t<div class="actions"></div>\n';
		html +='\t</div>';
    return html;
}

function updateMerchantsTotal(total){
	$(".headBox .total").text(total + " merchants");
}

function updateStoresTotal(total){
	$(".headBox .total").text(total + " stores");
}

function getMerchantsTotal(){
	var total = $(".headBox .total").text();
	total = total.split(" ")[0];
	total = parseInt(total);
}

function initMerchantsEvents(){
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
			    	var total = $(".headBox .total").text();
			    	total = total.split(" ")[0];
			    	total = parseInt(total);
			    	total = total - 1;
			    	$(".headBox .total").text(total + " merchants");
			    }
			}
		});
		
		/* Edit Actions */
		$('.merchants .item .actions .edit').click(function(){
			var name = $(this).parent().parent().children(".name").text();
			var email = $(this).parent().parent().children(".email").text();
			var status = $(this).parent().parent().children(".status").text();
			status = status.trim();
			$('#editMerchantDialog').reveal();
			$('.editMerchant input[name="oldEmail"]').val(email);
			$('.editMerchant input[name="name"]').val(name);
			$('.editMerchant input[name="email"]').val(email);
			$('.editMerchant option[value="'+status+'"]').attr("selected", "selected");
		});
	}		
	,function(){
		$(this).children(".actions").html("");
	});
	
	
	/* Edit Merchant event */
	$('.editMerchant button').click(function(){
		$(".editMerchant .notifications").html("");
		var vals = {};
		var data = $(".editMerchant form").serializeArray();
		vals["email"] = data[0]["value"].trim(),
		vals["name"] = data[1]["value"].trim(),
		vals["status"] = data[2]["value"].trim(),
		vals["newEmail"] = data[3]["value"].trim(),
		vals["password"] = data[4]["value"].trim();
		if (vals["name"] == "") {
			$(".editMerchant .notifications").html('<div class="error"> Name cannot be empty!</div>');
			$('.error').effect( "bounce", {times:3}, 300 );
		} else if (vals["newEmail"] == ""){
			$(".editMerchant .notifications").html('<div class="error"> Email cannot be empty!</div>');
			$('.error').effect( "bounce", {times:3}, 300 );
		} else{
			updateMerchant(vals);
			$(".editMerchant .notifications").html('<div class="confirmation"> Changes done!</div>');
			location.reload();
		}
	});
}


function initStoresEvents(){
	/* Stores */
	$('.stores .item').hover(function(){
		var actions = ' <span class="edit">Edit</span><span class="delete">Delete</span>';
		$(this).children(".actions").html(actions);
		
		/* Delete Actions */
		$('.stores .item .actions .delete').click(function(){
			var name = $(this).parent().parent().children(".name").text();
			var id = $(this).parent().parent().children(".id").text();
			if (confirm('Are you sure you want to delete ' + name + '?')) {
			    if(deleteStore(id)){
			    	var item = $(this).parent().parent();
			    	$(item).fadeOut(500, function(){$(item).remove(); });
			    	var total = $(".headBox .total").text();
			    	total = total.split(" ")[0];
			    	total = parseInt(total);
			    	total = total - 1;
			    	$(".headBox .total").text(total + " stores");
			    }
			}
		});
		
		/* Edit Actions */
		$('.stores .item .actions .edit').click(function(){
			var id = $(this).parent().parent().children(".id").text();
			var name = $(this).parent().parent().children(".name").text();
			var slogan = $(this).parent().parent().children(".slogan").text();
			var vat = $(this).parent().parent().children(".vat").text();
			var domain = $(this).parent().parent().children(".domain").text();
			//status = status.trim();
			$('#editStoreDialog').reveal();
			$('.editStore input[name="id"]').val(id);
			$('.editStore input[name="name"]').val(name);
			$('.editStore input[name="slogan"]').val(slogan);
			$('.editStore input[name="vat"]').val(vat);
			$('.editStore input[name="domain"]').val(domain);
			$('.editStore option[value="'+status+'"]').attr("selected", "selected");
		});
	}		
	,function(){
		$(this).children(".actions").html("");
	});
	
	
	/* Edit Store event */
	$('.editStore button').click(function(){
		$(".editStore .notifications").html("");
		var vals = {};
		var data = $(".editStore form").serializeArray();
		vals["id"]=data[0]["value"].trim(),
		vals["name"] = data[1]["value"].trim(),
		vals["slogan"] = data[2]["value"].trim(),
		vals["vat"] = data[3]["value"].trim(),
		vals["domain"] = data[4]["value"].trim();
		
		if (vals["name"] == "") {
			$(".editStore .notifications").html('<div class="error"> Name cannot be empty!</div>');
			$('.error').effect( "bounce", {times:3}, 300 );
		} else{
			updateStore(vals);
			$(".editStore .notifications").html('<div class="confirmation"> Changes done!</div>');
			location.reload();
		}
	});
}

/*
 * Adds a new store
 */
function addStore(name, slogan, vat, domain,logo){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/addStore.php?",{
		name: name,
        slogan: slogan,
        vat: vat,
        domain: domain,
        logo: logo
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"] == 'ok' ;
}

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

function deleteStore(id){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/deleteStore.php?",{
        id: id
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
 * Update Merchant
 */
function updateMerchant(values){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/updateMerchant.php?",values);
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"] == 'ok' ;
}


/*
 * Update Store
 */
function updateStore(values){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/updateStore.php?",values);
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"])["result"] == 'ok' ;
}

/*
 * Get merchants by status
 */

function getMerchantsByStatus(status){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/getMerchants.php?",{status : status});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"]);
}

/*
 * Search merchants
 */

function searchMerchants(terms){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/getMerchants.php?",{search : terms});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"]);
}

/*
 * Search stores
 */

function searchStores(terms){
	var permission = getSession()["permission"];
	var params = {search : terms};
	if(permission == "merchant"){
		params["merchantId"] = getSession()["id"];
	}
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/getStores.php?", params);
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"]);
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
 * Check add store
 * */
function addStoreIsValid(name,slogan,vat,domain){
	
	return true;
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

/**
 * Add a Store Owner
 */
function addStoreOwner(merchantEmail, storeDomain){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/plataform/addStoreOwner.php?",{
		domain: storeDomain,
		email: merchantEmail
	});
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"]);
}

/** 
 * Get session
 * */

function getSession(){
	$.ajaxSetup( { "async": false } );
	var data = $.getJSON("../ajax/getSession.php?");
	$.ajaxSetup( { "async": true } );
	return $.parseJSON(data["responseText"]);
}
