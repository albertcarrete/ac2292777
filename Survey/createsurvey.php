<?php include ('./header.php');
?>
<div class="row">
	<div class="grid_12">

		<div class="info-container narrow top">	
			<div class="head">
				<a href="./"><h1>Surveyor</h1></a>
				<p>Create Survey as <?php echo $_SESSION['username']; ?></p>				
			</div> <!-- end head -->

<?php 
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Required documents
	require ('./login_functions.inc.php');
	require ('./mysqli_connect.php');


	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	// $_SESSION['username'] = $data['username'];

	$errors = array(); // Initialize an error array.

	if(!empty($_POST['SurveyType'])){
		if($_POST['SurveyType'] === 'Single'){
			$part=1;
			include('./surveysingle.inc.php');
		}
			else{
				include('./surveymulti.inc.php');
		}
	}
	elseif((!empty($_POST['title']))){
		$_SESSION['title'] = $_POST['title'];

		$part=2;
		include('./surveysingle.inc.php');			
	}
	//SUBMIT RESPONSES - FINAL STEP
	elseif(!empty($_POST['Responses'])){

		$title = $_SESSION['title'];
		$owner = $_SESSION['username'];
		$responses = $_POST['Responses'];

		preg_match_all("/[^,\s][^\,]*[^,\s]*/", $_POST['Responses'], $output_array);
		$responseArray = array();
		$int = 1;

			foreach($output_array[0] as $value){
				$responseArray['Response'.$int]['Users'] = '';
				$int+=1;
			}

		$user_responses = serialize( $responseArray );


	if (empty($errors)) { // If everything's OK.
	
		// Register the surey in the database...
		
		// Make the query:
		$q = "INSERT INTO `$tablename`.`ac2292777_survey_surveys` (owner, title, questions, responses,reg_date) VALUES ('$owner', '$title', '$title', '$responses', NOW() )";		
		// $q = "INSERT INTO `$tablename`.`ac2292777_karate_users` (username, first_name, last_name, email, pass, isAdmin, isLoggedIn, registration_date)
		//  		VALUES (`test`, `test`, 'tester', `test@gmail.com`, SHA1('rofl'),'0', '0', NOW() )";		
		
		$r = @mysqli_query ($dbc, $q); 
		// Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Survey Complete</h1>
			<a href="./index.php">Click here to return home</a>';

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
	
		// echo '<h1>Error!</h1>';
		foreach ($errors as $msg) { // Print each error.
			echo "<p class='error'> $msg</p>\n";
		}		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.



		}
		else{
			echo"<p>Enountered a System Error, please try again";
		}


} // End of the main Submit conditional.
else{
?>
			<form action="createsurvey.php" method="post" autocomplete="off">
					<div class="mainselection">
						<select name="SurveyType" id="input7">
						    <option value="Single">Single Question</option>
						    <option value="Multi">Multi-Question</option>
						</select>
					</div>
			<p>Select the type of survey</p>
				<div class="clear"></div>	

				<input type="submit" name="submit" value="Next" />
				<div class="clear"></div>	
			</form>

<?php }?>
		</div>
	</div>
</div>
<?php include ('./footer.php'); ?>