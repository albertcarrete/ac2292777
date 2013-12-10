<?php include ('./header.php'); ?>

	<div class="row">	
		<div class="grid_12">
			<div class="info-container wide top">	
				<div class="head">
					<div class="logo">
					<a href="./"><h1>Surveyor</h1></a>
					</div>
					<div class="nav">
						<ul>
							<li><a href="./">Dashboard</a></li>
							<li><a href="./createsurvey.php">Create Survey</a></li>
							<?php if($_SESSION['isAdmin'] > 0){ ?>
							<li><a href="./my_surveys.php">Edit Surveys</a></li>
							<?php }
							else{ ?>
							<li><a href="./my_surveys.php">My Surveys</a></li>

							<?php }

							?>							<li><a href="./settings.php">Settings</a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>

	<div class="grid_12">
		<div class="info-container wide">
			<div class="subhead">
				<h3>My Surveys</h3>
			</div>

	<?php 
	require ('./mysqli_connect.php'); 


	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];

	if($_SESSION['isAdmin'] > 0){
	$q = "SELECT title, owner,DATE_FORMAT(reg_date, '%M %d, %Y') AS dr, survey_id FROM `$tablename`.`ac2292777_survey_surveys`";	
	$queryUserSurveys 		= @mysqli_query ($dbc, $q); // Run the query.
	}
	else{
	$q = "SELECT title, DATE_FORMAT(reg_date, '%M %d, %Y') AS dr, survey_id FROM `$tablename`.`ac2292777_survey_surveys` WHERE owner = '$username'";	
	$queryUserSurveys 		= @mysqli_query ($dbc, $q); // Run the query.
	}
	echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
	<tr>
		<th><a href="view_users.php?sort=ln">Title</a></th>
		<th><a href="view_users.php?sort=fn">Created</a></th>
		<th><a href="view_users.php?sort=rd">View</a></th>
		<th><a href="view_users.php?sort=rd">Delete</a></th>

	</tr>';

	$row2 = mysqli_fetch_array($queryUserSurveys, MYSQLI_ASSOC);
	if($row2){
		mysqli_data_seek($queryUserSurveys,0); // reset fetch
		while ($row = mysqli_fetch_array($queryUserSurveys, MYSQLI_ASSOC)){

			$style = ($style=='alt' ? 'alt2' : 'alt');
			echo '<tr class="' . $style . '">
			<td align="left">' . $row['title'] . '</td>
			<td align="left">' . $row['dr'] . '</td>
			<td align="left"><a href = "view_results.php?id='.$row['survey_id'].'">View</a></td>
			<td align="left"><a href = "delete_survey.php?id='.$row['survey_id'].'">Delete</a></td>';

		}
			echo '</table>';
	}
	else{ ?>
		</table>
		<h2>No surveys to display</h2>
	<?php } ?>

	</div>
</div>

<?php include ('./footer.php'); ?>
