<?php include ('./header.php'); 
// Required Documentation
require ('./mysqli_connect.php'); // Connect to the db.
require ('./login_functions.inc.php'); 
if(($_SESSION['isAdmin'])>0){

?>
	<div class="row content">
		<div class="grid_12">
<?php 

// Make the query:
$q = "SELECT CONCAT(last_name, ', ', first_name) AS name, email AS em FROM `$tablename`.`ac2292777_contacts`";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);


?>
<div class="main-title">
	<h1 class = "fl_r">There are currently <?php echo $num ?> contacts.</h1>
	<div class="clear"></div>
</div>

<?php

if ($num > 0) { // If it ran OK, display the records.

	// Table header.
	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>Name</b></td><td align="left"><b>Contact Email</b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['em'] . '</td></tr>
		';
	}

	echo '</table>'; // Close the table.
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no contacts.</p>';

}

mysqli_close($dbc); // Close the database connection.
?>
</div>
</div>
<?php 
}else{
	redirect_user();
}

?>
<?php include ('./footer.php'); ?>