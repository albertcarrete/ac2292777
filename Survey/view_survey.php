<?php include ('./header.php'); ?>
	<div class="row">
		<div class="grid_12">
			<div class="info-container narrow top">	

				
<?php 
// IF USER HAS POSTED DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Required documents
	require ('./login_functions.inc.php');
	require ('./mysqli_connect.php'); ?>


	<div class="head">
		<div class="logo">
			<a href="./"><h1>Surveyor</h1></a>
		</div>
		<p>Survey Results</p>
	</div>

<?php 
// ==================================================
//    ___   ____ ____ ___   ____   _  __ ____ ____
//   / _ \ / __// __// _ \ / __ \ / |/ // __// __/
//  / , _// _/ _\ \ / ___// /_/ //    /_\ \ / _/  
// /_/|_|/___//___//_/    \____//_/|_//___//___/                                                                                          
// 
	$userResponse 	= $_POST['response'];			// RESPONSE POSTED FROM FORM
	$surveyID 		= $_SESSION['temp_surveyID'];	// ID OF SURVEY BEING TAKEN
	$userSessionID 	= $_SESSION['user_id'];

// 	RETRIEVING THE RESPONSES FROM THE DATABASE
	$responseInsert = "INSERT INTO `$tablename`.`ac2292777_survey_responses` 
	(survey_id, user_id, user_response, date_submitted) 
	VALUES ('$surveyID', '$userSessionID', '$userResponse', NOW() )";		


	$r = @mysqli_query ($dbc, $responseInsert);

	if ($r) { // Insert ran sucessfully
		?>
		<div class="results">
			<h4>Response Submitted Successfully</h4>
			<img src="./img/success.png" alt="">
			<a class="result-button" href="./">Dashboard</a>
			<a class ="result-button" href='./view_results.php?id=<?php echo $surveyID; ?>'>View Results</a>
			<div class="clear"></div>
		</div>
		<?php
	}
	else{
		echo '<p class="error">Could not submit response.</p>';

	}
		mysqli_close($dbc); // Close the database connection.

}
else{
?>
				<div class="head">
					<div class="logo">
						<a href="./"><h1>Surveyor</h1></a>
					</div>
					<p>Survey In Progress</p>
				</div>
<?php 
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
}

require ('./mysqli_connect.php');

$_SESSION['temp_surveyID'] = $id;

$q = "SELECT owner, title, responses,reg_date FROM `$tablename`.`ac2292777_survey_surveys` WHERE survey_id=$id";		
$r = @mysqli_query ($dbc, $q);
if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// echo $row[0].$row[1].$row[2];

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}
mysqli_close($dbc);

?>
				<div class="subhead">
					<h3><?php echo $row[1]; ?></h3>
				<div class="survey-meta">
					<h5 class="author-meta">Author: <?php echo $row[0]; ?></h5>
					<h5 class="date-meta">Posted: <?php echo $row[3]; ?></h5>
					<div class="clear"></div>

				</div>
				</div>
			<form action="view_survey.php" method="post" autocomplete="off">

				<?php preg_match_all("/[^,\s][^\,]*[^,\s]*/", $row[2], $output_array);

				foreach($output_array[0] as $value){?>
					<p class="bullet"><input type="radio" name="response" value="<?php echo $value ?>"><?php echo $value ?></p>

				<?php 
				} ?>
				<div class="clear"></div>
				<input type="submit" name="submit" value="Submit Response" />
				<div class="clear"></div>	
			</form>

<?php } //end else ?>


			</div>		
		</div>

<!-- 		<div class="grid_6">
			<div class="info-container">
				<div class="subhead">
					<h3>Results</h3>
				</div>
				
			</div>		
		</div> -->
	</div>
<?php include ('./footer.php'); ?>