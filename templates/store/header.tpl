<!DOCTYPE html>
<html>
<head>
<title>{$title}</title>
<!--  CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/store/frontend.css">
    <!--  Javascript  -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../../javascript/jquery-ui.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../lib/raty/jquery.raty.js"></script>
    <script type="text/javascript" src="../../javascript/crypt.js"></script>
    <script type="text/javascript" src="../../javascript/store/frontend.js"></script>

</head>
<body>

	<!-- Header -->
	<div class="bodyContainer">
	   
		<header>
			<img src="{$logoPath}" alt="Logo" class="logo" />
			{if $userPermission != "guest"}
			<div class="search form-search">
                  <div class="input-append">
                    <input type="text" class="span2 search-query">
                    <button type="submit" class="btn">Search</button>
                  </div>
            </div>    
            {/if}
			{if !isset($userInfo)}
			<div class="login">
				<div class="form-inline">
					<input type="text" class="input" id="login_email" placeholder="Email"> 
					<input type="password" class="input-medium" id="login_pass" placeholder="Password">

					<button class="btn" id="login">Login</button>
					<a href="#registrationModal" role="button" class="btn btn-inverse"
						data-toggle="modal">Register</a>
				</div>
				 <div id="userNotification"></div>
			</div>
			
			{else}
			<div class="logout">
				<a class="username" href="account.php?store={$storeDomain}">Welcome {$userInfo.name} </a>
				<button class="btn" id="logout">Logout</button>
			</div>
			{/if}
		</header>
	</div>
	<!--  Navigation -->
	<div class="bodyContainer">
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
				    <li class="" id="storeHome"><a href="index.php?store={$storeDomain}"><i class="icon-home"></i> Home</a></li>
				    <li class="" id="storeFavorites"><a href="favorites.php?store={$storeDomain}"><i class="icon-star"></i> Favorites</a></li>
				    <li class="" id="storeSubscriptions"><a href="subscriptions.php?store={$storeDomain}"><i class="icon-bookmark"></i> Subscriptions</a></li>
				    <li class="" id="storeCart"><a href="cart.php?store={$storeDomain}"><i class="icon-shopping-cart"></i> Cart <span  id="cartTotal"></span></a></li>
				</ul>
			</div>
			
		</div>
	</div>



	<!-- Modal -->
	<div id="registrationModal" class="modal hide fade register" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">×</button>
			<h3 id="myModalLabel">Registration</h3>
		</div>
		<div class="modal-body">
			<!--  Body -->
		    <div class="registerNotification">
		    </div>
			<form id="registerForm">
	            <input type="text" id="name" placeholder="Name">
	            <input type="text" id="email" placeholder="Email">
	            <input type="password" id="password" placeholder="Password">
	            <input type="password" id="confirmPassword" placeholder="Confirm Password">
	            <input type="hidden" id="storeId" value="{$storeId}">
	            <input type="hidden" id="storeDomain" value="{$storeDomain}">
	        </form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" id="registerButton" >Register</button>
		</div>
	</div>
