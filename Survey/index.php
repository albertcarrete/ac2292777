<?php # Script 12.12 - login.php #4
include ('./header.php');

// = = = = = = = = = = = = = 
// Check for a session user
// = = = = = = = = = = = = = 
if (isset($_SESSION['user_id'])) { ?>

	<div class="row">	
		<div class="grid_12">
			<div class="info-container wide top">	
				<div class="head">
					<div class="logo">
					<a href="./"><h1>Surveyor</h1></a>
					</div>
<?php if($_SESSION['isAdmin'] > 0){ ?>
					<div class="nav admin">
						<ul>
							<li><a href="./">Dashboard</a></li>
							<li><a href="./createsurvey.php">Create Survey</a></li>
							<li><a href="./my_surveys.php">Edit Surveys</a></li>
							<li><a href="./my_surveys.php">Edit Users</a></li>
							<li><a href="./settings.php">Settings</a></li>
						</ul>
					</div>
	<?php }
	else{ ?>
					<div class="nav user">
						<ul>
							<li><a href="./">Dashboard</a></li>
							<li><a href="./createsurvey.php">Create Survey</a></li>
							<li><a href="./my_surveys.php">My Surveys</a></li>
							<li><a href="./settings.php">Settings</a></li>
						</ul>
					</div>
	<?php } ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>

		<div class="grid_9">
			<div class="info-container wide">
				<div class="subhead">
				<h3>Active Surveys</h3>
			</div>
			
<?php require ('./mysqli_connect.php'); 

	// Number of records to show per page:
	$display = 10;

	// Determine how many pages there are...
	if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.

		$pages = $_GET['p'];

	} else { // Need to determine.

	 	// Count the number of records:
		$q = "SELECT COUNT(survey_id) FROM `$tablename`.`ac2292777_survey_surveys`";
		$r = @mysqli_query ($dbc, $q);
		$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
		$records = $row[0];
		// Calculate the number of pages...
		if ($records > $display) { // More than 1 page.
			$pages = ceil ($records/$display);
		} else {
			$pages = 1;
		}
	} // End of p IF.

	// Determine where in the database to start returning results...
	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$start = $_GET['s'];
	} else {
		$start = 0;
	}

	// Determine the sort...
	// Default is by registration date.
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

	// Determine the sorting order:
	switch ($sort) {
		case 'ln':
			$order_by = 'last_name ASC';
			break;
		case 'fn':
			$order_by = 'first_name ASC';
			break;
		case 'rd':
			$order_by = 'registration_date ASC';
			break;
		default:
			$order_by = 'registration_date ASC';
			$sort = 'rd';
			break;
	}
	
	$user_id = $_SESSION['user_id'];
	// Define the query:
	$checkResponse 	= "SELECT survey_id FROM `$tablename`.`ac2292777_survey_responses` WHERE user_id=$user_id";		
	$q 				= "SELECT owner, title, DATE_FORMAT(reg_date, '%M %d, %Y') AS dr, survey_id FROM `$tablename`.`ac2292777_survey_surveys`";	

	$queryCheckResponse 	= @mysqli_query ($dbc, $checkResponse); // Run the query.
	$r 						= @mysqli_query ($dbc, $q); // Run the query.

	// Table header:
	echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
	<tr>
		<th><a href="view_users.php?sort=ln">Title</a></th>
		<th><a href="view_users.php?sort=fn">Author</a></th>
		<th><a href="view_users.php?sort=rd">Created</a></th>
		<th>Take</th>
	</tr>';

	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){

		$style = ($style=='alt' ? 'alt2' : 'alt');
		echo '<tr class="' . $style . '">
		<td align="left">' . $row['title'] . '</td>
		<td align="left">' . $row['owner'] . '</td>
		<td align="left">' . $row['dr'] . '</td>';

		mysqli_data_seek($queryCheckResponse,0); // reset fetch
		while( $rowtwo = mysqli_fetch_array($queryCheckResponse, MYSQLI_ASSOC)){


			if($rowtwo['survey_id']==$row['survey_id']){ // If there is a survey_id match, break loop and report a matchfound
				$matchfound = true;
				break;
			}
			else{
				$matchfound = false;
			}

		}

		if($matchfound == true){
			echo'<td class='.$row['survey_id'].'vs'.$rowtwo['survey_id'].' align="left"><a href="view_results.php?id=' . $row['survey_id'] . '">Results</a></td>';

		}
		else{
				echo'<td class='.$row['survey_id'].'vs'.$rowtwo['survey_id'].' align="left"><a href="view_survey.php?id=' . $row['survey_id'] . '">Take</a></td>';

		}
	}
echo '</table>';

mysqli_free_result ($r);
mysqli_free_result ($queryCheckResponse);

mysqli_close($dbc);
		?>



		</div>
	</div>
	<div class="grid_3">
		<div class="info-container wide">
				<div class="subhead">
				<h3>Profile</h3>
			</div>
			<img class="profile_picture" src="./IMG/profile_default.png" alt="">
			<h5><?php echo $_SESSION['username']; ?></h5>

		</div>
	</div>
	<div class="grid_12">
		<div class="info-container wide top">	
			<p><a href="./logout.php">Log out of <?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?> (<?php echo $_SESSION['username']; ?> )</a></p>			

		</div>
	</div>
</div>

<?php } else {  // tied to isset($_SESSION('user_id'))

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require ('./login_functions.inc.php');
	require ('./mysqli_connect.php');		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!


		// Set the session data:
		$_SESSION['user_id'] 		= $data['user_id'];
		$_SESSION['username'] 		= $data['username'];
		$_SESSION['first_name'] 	= $data['first_name'];
		$_SESSION['last_name']		= $data['last_name'];
		$_SESSION['isAdmin'] 		= $data['isAdmin'];
		$_SESSION['title'] 			= "Default Title";
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

?>

<?php include ('./login_page.inc.php'); ?>

<?php } ?>

<?php include ('./footer.php'); ?>