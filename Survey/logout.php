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
				<div class="logo">
					<h1>Surveyor</h1>
				</div>
				<p>Notification</p>
			</div>
			<div class="results">
			<h4>Logged Out Successfully</h4>
			<img src="./img/success.png" alt="">
			<a class="result-button" href="./">Log In</a>
			<a class ="result-button" href='./info.php'>Info</a>
			<div class="clear"></div>
			</div>
	</div>
</div> <!-- end row-->

<?php
include ('./footer.php');
?>