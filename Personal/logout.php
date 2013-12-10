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
?>
  <div class="row"> 
    <div class="grid_12 centered">
      <a href="./index.php"><img class="logo" src="./images/logo.png" alt=""></a>
      <h2>You've Been Logged Out</h2>
  </div>
</div>

<?php
include ('./footer.php');
?>