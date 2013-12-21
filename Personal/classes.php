<?php 
/**
* 
*/
class Panel
{
	
	function userPanel(){ ?>

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

	
	$user_id = $_SESSION['user_id'];

	$selectSubjects 		= "SELECT subject_id,title FROM `$tablename`.`ac2292777_personal_subjects`";	
	$selectSubCategories 	= "SELECT subcategory_id,title,parent_id FROM `$tablename`.`ac2292777_personal_subcategories`";		

	$querySubjects			= @mysqli_query ($dbc, $selectSubjects); // Run the query.
	$querySubCategories		= @mysqli_query ($dbc, $selectSubCategories); // Run the query.

	// Table header:

	while ($subjects = mysqli_fetch_array($querySubjects, MYSQLI_ASSOC)){ ?>
		<div class="subjects">
			<div class="head">
			<h3><?php echo $subjects['title']; ?></h3>
			</div>
			<ul>

	<?php	mysqli_data_seek($querySubCategories,0); // reset fetch

	while ($subCategories = mysqli_fetch_array($querySubCategories, MYSQLI_ASSOC)){ 

			if($subjects['subject_id']==$subCategories['parent_id']){?>
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
<?php 




	}
	function adminPanel(){
 		require ('./mysqli_connect.php');
	 ?>

	<div class="row">	
		<div class="grid_12">
		<?php

		$selectClasses 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body FROM `ac2292777_personal_classes`";		
		$queryClasses	= @mysqli_query ($dbc, $selectClasses); // Run the query.
		
	while ($classes = mysqli_fetch_array($queryClasses, MYSQLI_ASSOC)){ 

			$parent_subject_id 			= $classes['parent_subject_id'];
			$selectSubCategories 		= "SELECT title FROM `$tablename`.`ac2292777_personal_subcategories` WHERE subcategory_id = $parent_subject_id";
			$querySubCategories			= @mysqli_query ($dbc, $selectSubCategories); // Run the query.
			$subCategories 				= mysqli_fetch_array($querySubCategories,MYSQLI_ASSOC);

?>
		<a class="class" href="view_class.php?id=<?php echo $classes['class_id']; ?>">
	
		<div class=" class">
			<div class="title">
				<h4><?php echo $classes['title']; ?></h4>
			</div>
			<div class="description">
				<p><?php echo $classes['description']; ?></p>
			</div>
			<div class="meta">
				<span class="posted">Posted: </span><?php echo $classes['date_created']; ?><span class="author"> Author: </span>Albert Carrete
			</div>
		</div>
		<img src="./images/classimg.png" alt="">
	<div class="clear"></div>

	</a>

			<?php 
		}		 ?>	



		</div>
	</div>

<?php	
	}




}
 ?>