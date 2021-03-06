<?php # Script 12.12 - login.php #4
// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security.
include ('./header.php');


					if (isset($_SESSION['user_id'])) {
						echo '<p>Logged in as '.$_SESSION['first_name'].$_SESSION['last_name'].'</p>';

					} else {

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require ('./login_functions.inc.php');
	require ('./mysqli_connect.php');


	$tablename = '47924';
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
		ini_set('session.gc_maxlifetime',5);
		ini_set('session.gc_probability',1);
		// Set the session data:
		session_start();
		$_SESSION['user_id'] 			= $data['user_id'];
		$_SESSION['first_name'] 	= $data['first_name'];
		$_SESSION['last_name']		= $data['last_name'];
		$_SESSION['isAdmin'] 		= $data['isAdmin'];
		
		// Store the HTTP_USER_AGENT:
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		// Redirect:
		redirect_user('loggedin.php');
			
	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.




						include ('./login_page.inc.php');
					}

// Create the page:
?>
<?php include ('./footer.php'); ?>