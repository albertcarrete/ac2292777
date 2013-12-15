<?php # Script 12.11 - logout.php #2
// This page lets the user logout.
// This version uses sessions.
include ('./header.php');

// If no session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('./login_functions.inc.php');
	redirect_user();	
	
} else { // Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_unset();
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.

}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
?>
<div class="row">
	<div class="grid_12">
		<div class="info-container narrow">		
			<div class="head">
				<h1>Surveyor</h1>
				<p>Notification</p>
			</div>
			<h3>Logged Out!</h3>
			<a href=""><p>You are now logged out!</p></a>
		</div>
	</div>
</div> <!-- end row-->

<?php
include ('./footer.php');
?>