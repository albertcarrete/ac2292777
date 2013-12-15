<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';?>

<div class="row">
	<div class="grid_12">
		<div class="info-container narrow top">		
<?php


// Display the form:
?>
			<div class="head">
				<div class="logo">
					<h1>Surveyor</h1>
				</div>
				<p>Log In</p>
			</div>
		<?php 
if (isset($errors) && !empty($errors)) {
	echo '
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p>';
}
		?>
		<form action="./index.php" method="post" autocomplete="off">
				<input type="text" name="email" size="20" maxlength="30" placeholder="EMAIL" autocomplete="off"/>
				<input type="password" name="pass" size="20" maxlength="20" placeholder="PASS"/>
				<div class="clear"></div>
				<input type="submit" name="submit" value="Login" />
				<div class="clear"></div>	
		</form>
				<a class="account" href="./signup.php">Create an Account</a>
				<a class="password" href="./password.php">Forgot Your Password?</a>

		</div>
	</div>
</div> <!-- end row-->

<?php include ('./footer.php'); ?>