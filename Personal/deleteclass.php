<?php include ('./header.php'); ?>
<div class="class-view">
<div class="row">
	<div class="grid_4 offset_4">

<?php 
	// Required documentation
	require ('./mysqli_connect.php'); // Connect to the db.
  	require ('./login_functions.inc.php');


if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	echo '</div>';
	include ('./footer.php'); 
	exit();
}

	$sr = "DELETE FROM `$tablename`.`ac2292777_personal_classes` WHERE class_id ='$id' LIMIT 1";		
	$r 		= @mysqli_query ($dbc, $sr); // Run the query.
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK. ?>
			<div class="notification">
				<a href="./managemyclasses.php"><img src="./images/trash.png" alt=""></a>
				<h2 class="text-center">The class has been deleted.</h2>
			</div>
<?php } else { // If the query did not run OK.
			echo '<div class="notification">';
			echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			echo '</div>';
}
		?>

	</div>
</div>

</div>
<?php include ('./footer.php'); ?>		