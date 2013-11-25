<?php include "./header.php" ?>

<div class="row">
	<div class="grid_12">
		<div class="main-title">
			<h1 class = "fl_l">Contact</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="grid_12">
<?php
$page_title = 'Contact';
$tablename = '47924';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.



	$firstnameCheck = $_POST['first_name'];

	$regexName = "/^[a-zA-z]{1,19}$/";
	$regexEmail = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";

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
	// Check for comments
	if (empty($_POST['comments'])) {
		$errors[] = 'You forgot to enter a message.';
	}
	 else {
		$cmts = mysqli_real_escape_string($dbc, trim($_POST['comments']));
	}	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO `$tablename`.`ac2292777_contacts` (first_name, last_name, email, comments) VALUES ('$fn', '$ln', '$e', '$cmts')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>Thank you for contacting us, we will get back to you shortly</p><p><br /></p>';	
		
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



}



?>



	<form class = "contactbox" action="contact.php" method = "post">
	<p>Fill out this form and we'll get back to you as soon as possible.</p>

	<p>First Name <input type="text" name="first_name" size="30" maxlength="60" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>	
	<p>Last Name <input type="text" name="last_name" size="30" maxlength="60" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>		
	<p>Email Address <input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	<p>Comments <textarea name="comments" rows="5" cols="30"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea></p>
	<p><input type="submit" name="submit" value="Send!" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
	</form>
</div>
</div>
<?php include "./footer.php" ?>