<?php include ('./header.php'); ?>
<div class="class-view">
<div class="row">
	<div class="grid_10 offset_1">

<?php 

	require ('./mysqli_connect.php'); 
	require ('./login_functions.inc.php');

	// Check for a valid user ID, through GET or POST:
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

	$selectClasses 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body FROM `$tablename`.`ac2292777_personal_classes` WHERE parent_subject_id=$id";		
	$queryClasses	= @mysqli_query ($dbc, $selectClasses); // Run the query.
		
	while ($classes = mysqli_fetch_array($queryClasses, MYSQLI_ASSOC)){ 
		if($id == $classes['parent_subject_id']){?>

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

			<?php }
		}	

?>
	</div>	
</div>
</div>
<?php include ('./footer.php'); ?>