<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include ('./header.php');?>

<div class="row">
	<div class="grid_12">


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

<div class="grid_6">
<form class="contactbox" action="login.php" method="post">


<h1>Login</h1>

	<p><input type="text" name="email" size="20" maxlength="60" placeholder="Email" /> </p>
	<p><input type="password" name="pass" size="20" maxlength="20" placeholder="Password" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form>
</div>
</div>
</div>
<?php include ('./footer.php'); ?>