<?php # Script 12.12 - login.php #4
include ('./header.php');

// = = = = = = = = = = = = = 
// Check for a session user
// = = = = = = = = = = = = = 
if (isset($_SESSION['user_id'])) { ?>

	<div class="row">	
		<div class="grid_12">
			
<?php require ('./mysqli_connect.php'); 

	// Number of records to show per page:
	$display = 10;

	// Determine how many pages there are...
	if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.

		$pages = $_GET['p'];

	} else { // Need to determine.

	 	// Count the number of records:
		$q = "SELECT COUNT(survey_id) FROM `$tablename`.`ac2292777_personal_classes`";
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

	$selectSubjects 		= "SELECT title FROM `$tablename`.`ac2292777_personal_subjects`";	
	$selectSubCategories 	= "SELECT subcategory_id,title,parent_subject FROM `$tablename`.`ac2292777_personal_subcategories`";		

	$querySubjects		= @mysqli_query ($dbc, $selectSubjects); // Run the query.
	$querySubCategories		= @mysqli_query ($dbc, $selectSubCategories); // Run the query.

	// Table header:

	while ($subjects = mysqli_fetch_array($querySubjects, MYSQLI_ASSOC)){ ?>
		<div class="subjects">
			<h3><?php echo $subjects['title']; ?></h3>
			<ul>

	<?php	mysqli_data_seek($querySubCategories,0); // reset fetch

	while ($subCategories = mysqli_fetch_array($querySubCategories, MYSQLI_ASSOC)){ 

			if($subjects['title']==$subCategories['parent_subject']){?>
				<li><a href="./view_subject.php?id=<?php echo $subCategories['subcategory_id']; ?>"><?php echo $subCategories['title']; ?></a></li>

			<?php }	?>

	<?php } ?>
			</ul>
		</div>
		<?php 
	}

mysqli_free_result ($querySubjects);

mysqli_close($dbc);
		?>



		</div>
	</div>

<?php } else {  // tied to isset($_SESSION('user_id'))?>
	<div class="row">
		<div class="grid_12 intro">
			<a href="./login.php"><img class="logo" src="./images/logo.png" alt=""></a>
		</div>
		<div class="grid_6 centered">
			<div class="centered">
				<h4>Peer Collaborative Knowledge</h4>
			</div>
		</div>
	</div>

<?php } ?>

<?php include ('./footer.php'); ?>