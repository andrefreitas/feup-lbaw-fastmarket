
</div>
</div>

<!--  Edit account -->
<div id="myAccountDialog" class="reveal-modal register">
	<h1>My Account</h1>
	<div class="myAccount">
		<form>
			<div class="registerNotification"></div>
			<input type="hidden" name="oldEmail" value="{$smarty.session.email}"/><br /> 
			<input type="text" name="name" placeholder="name..." value="{$smarty.session.name}"/><br /> 
			<input type="email" name="email" placeholder="email..." value="{$smarty.session.email}"/><br /> 
			<input type="password" name="password" placeholder="change password" /><br /> 
			<input type="password" name="password_check" placeholder="confirm password" /><br />
			<button type="button" name="register">Update Account</button>
		</form>
	</div>
	<a class="close-reveal-modal">&#215;</a>
</div>

</body>
</html>
