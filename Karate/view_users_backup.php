<?php include ('./header.php'); ?>
			<div class="sixteen columns content center">
				<?php include "nav-admin.php"; ?>
<?php # Script 9.6 - view_users.php #2
// This script retrieves all the records from the users table.

$page_title = 'View the Current Users';

// Page header:
require ('./mysqli_connect.php'); // Connect to the db.
	
$tablename = '47924';
$display = 10;
	
// Make the query:
$q = "SELECT CONCAT(last_name, ', ', first_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM `$tablename`.`ac2292777_users` ORDER BY registration_date ASC";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);
?>
<div class="main-title">
	<h1 class = "fl_l">Registered Users</h1>
	<h1 class = "fl_r">There are currently <?php echo $num ?> registered users.</h1>
</div>

<?php
if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	// Table header.
	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>Name</b></td><td align="left"><b>Date Registered</b></td></tr>';	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>
		';
	}

	echo '</table>'; // Close the table.
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no registered users.</p>';

}

mysqli_close($dbc); // Close the database connection.

?>

</div>
<?php include ('./footer.php'); ?>