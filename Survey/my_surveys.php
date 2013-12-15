<?php include ('./header.php'); ?>

	<div class="row">	
		<?php include ('./navbar.php');?>


	<div class="grid_12">
		<div class="info-container wide">
			<div class="subhead">
				<h3>My Surveys</h3>
			</div>

	<?php 
	require ('./mysqli_connect.php'); 

$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'title':
		$order_by = 'title ASC';
		break;
	case 'author':
		$order_by = 'owner ASC';
		break;
	case 'created':
		$order_by = 'dr ASC';
		break;
	default:
		$order_by = 'dr ASC';
		$sort = 'created';
		break;
}

	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];

	if($_SESSION['isAdmin'] > 0){
	$q = "SELECT title, owner,DATE_FORMAT(reg_date, '%M %d, %Y') AS dr, survey_id,owner FROM `$tablename`.`ac2292777_survey_surveys` ORDER BY $order_by";	
	$queryUserSurveys 		= @mysqli_query ($dbc, $q); // Run the query.
	}
	else{
	$q = "SELECT title, DATE_FORMAT(reg_date, '%M %d, %Y') AS dr, survey_id FROM `$tablename`.`ac2292777_survey_surveys` WHERE owner = '$username'";	
	$queryUserSurveys 		= @mysqli_query ($dbc, $q); // Run the query.
	}
	echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
	<tr>
		<th><a href="my_surveys.php?sort=title">Title</a></th>
		<th><a href="my_surveys.php?sort=created">Created</a></th>';
		if($_SESSION['isAdmin'] > 0){
			echo '<th><a href="my_surveys.php?sort=author">Author</a></th>';
		}

	echo '<th>View</th>
		<th>Delete</th>

	</tr>';

	$row2 = mysqli_fetch_array($queryUserSurveys, MYSQLI_ASSOC);

	$style = 'alt';
	if($row2){
		mysqli_data_seek($queryUserSurveys,0); // reset fetch
		while ($row = mysqli_fetch_array($queryUserSurveys, MYSQLI_ASSOC)){

			$style = ($style=='alt' ? 'alt2' : 'alt');
			echo '<tr class="' . $style . '">
			<td align="left">' . $row['title'] . '</td>
			<td align="left">' . $row['dr'] . '</td>';
			if($_SESSION['isAdmin'] > 0){
			echo '<td align="left">' . $row['owner'] . '</td>';
			}
			echo '<td align="left"><a href = "view_results.php?id='.$row['survey_id'].'">View</a></td>
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
	<div class="grid_12">
		<div class="info-container wide top">	
			<p><a href="./logout.php">Log out of <?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?> (<?php echo $_SESSION['username']; ?> )</a></p>			

		</div>
	</div>
</div>
<?php include ('./footer.php'); ?>
