<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include ('./header.php');?>

<div class="row">
	<div class="grid_12">
		<div class="info-container narrow top">		
<?php

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// Display the form:
?>
			<div class="head">
				<h1>Surveyor</h1>
				<p>Log In</p>
			</div>
		
		<form action="index.php" method="post" autocomplete="off">
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