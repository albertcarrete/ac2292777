<?php include "header.php"; ?>
<div class="row">	
	<div class="grid_12">
			<h1 class = "fl_l">Sign Up</h1>


		<?php # Script 9.5 - register.php #2
		// This script performs an INSERT query to add a record to the users table.

		$page_title = 'Register';
		$tablename = '47924';


// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.


	//Regular Expressions
	$regexName = "/^[a-zA-z]{1,19}$/";
	$regexEmail = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";

	$usernameCheck = $_POST['username'];

	if(empty($_POST['username'])){
		$errors[] = "Username field was blank";
	}
	elseif(!preg_match($regexName,$usernameCheck)){
		$errors[] = 'Invalid firstname, please use only upper and lowercase letters';
	}
	else{
		$un = mysqli_real_escape_string($dbc, trim($_POST['username']));		
	}

	$firstnameCheck = $_POST['first_name'];

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	}
	elseif(!preg_match($regexName,$firstnameCheck)){
		$errors[] = 'Invalid firstname, please use only upper and lowercase letters';
	}
	 else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	$lastnameCheck = $_POST['last_name'];
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	}
	elseif(!preg_match($regexName,$lastnameCheck)){
		$errors[] = 'Invalid last name, please use only upper and lowercase letters';
	}
	 else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	$emailCheck = $_POST['email'];
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	}
	elseif(!preg_match($regexEmail,$emailCheck)){
		$errors[] = 'Invalid email, enter again';
	}
	 else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	$isA = 0;
	$isL = 0;
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO `$tablename`.`ac2292777_karate_users` (username, first_name, last_name, email, pass, isAdmin, isLoggedIn, registration_date) VALUES ('$un', '$fn', '$ln', '$e', SHA1('$p'),'$isA', '$isL', NOW() )";		
		// $q = "INSERT INTO `$tablename`.`ac2292777_karate_users` (username, first_name, last_name, email, pass, isAdmin, isLoggedIn, registration_date)
		//  		VALUES (`test`, `test`, 'tester', `test@gmail.com`, SHA1('rofl'),'0', '0', NOW() )";		
		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Registration Complete</h1>
			<a href="./signin.php">Click here to login</a>';
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

<form class="contactbox" action="signup.php" method="post">


	<p>Sign up to view your accolades and receieve information on tournaments.</p>
	<p>Username: <input type="text" name="username" size="15" maxlength="20" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /></p>
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>
</div>
</div>
<?php include "footer.php"; ?>