<?php include ('./header.php');?>

<div class="row">
	<div class="grid_12">

		<div class="info-container narrow top">	
			<div class="head">
				<a href="./"><h1>Surveyor</h1></a>
				<p>Notification</p>

			</div> <!-- end head -->

<?php 
	require ('./mysqli_connect.php'); 

	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];

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

	$q 		= "SELECT owner, title, DATE_FORMAT(reg_date, '%M %d, %Y') AS dr, survey_id FROM `$tablename`.`ac2292777_survey_surveys` WHERE owner='$username' AND survey_id ='$id'";	
	$r 		= @mysqli_query ($dbc, $q); // Run the query.

	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
	

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		if($_SESSION['username']==$row['owner']){ // If there is a survey_id match, break loop and report a matchfound 
		// Make the query:
		$sr = "DELETE FROM `$tablename`.`ac2292777_survey_surveys` WHERE survey_id=$id LIMIT 1";		
		$surveyDelete = @mysqli_query ($dbc, $sr);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK. ?>

			<div class="results">
				<h4>Survey Deleted Successfully</h4>
				<img src="./img/success.png" alt="">
			</div>

		<?php } else { // If the query did not run OK.
			echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		} ?>

	<?php  } else{ ?>
			<div class="results">
				<h4>You Do Not Have Succicient Priveledges</h4>
				<img src="./img/confirm.png" alt="">
			</div>
		<?php }
		?>
<?php 

	}
}
else{ ?>

	<div class="results">
		<h4>Delete Survey</h4>
		<h5>"<?php echo $row['title'];?>"</h5>
		<img src="./img/confirm.png" alt="">
		<?php
		// Create the form:
		echo '<form action="delete_survey.php" method="post">
			<input class="result-button" type="submit" name="submit" value="Yes" />
			<a class = "result-button" href="./my_surveys.php">No</a>
			<div class="clear"></div>
			<input type="hidden" name="id" value="' . $id . '" />
			<input type="hidden" name="sure" value="Yes" />
			</form>';
		?>
	</div>

<?php
}
?>
		</div>
	</div>
</div>

<?php include ('./footer.php'); ?>
