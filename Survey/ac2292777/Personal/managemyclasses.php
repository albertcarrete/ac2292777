<?php include ('./header.php'); ?>
<div class="class-view">
<div class="row">
	<div class="grid_10 offset_1">
		<h2 class="text-center">Select a Class to Edit</h2>

<?php 

	require ('./mysqli_connect.php'); 
	require ('./login_functions.inc.php');

	$user_id = $_SESSION['user_id'];

	$selectClasses 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body FROM `$tablename`.`ac2292777_personal_classes` WHERE user_id=$user_id";		
	$queryClasses	= @mysqli_query ($dbc, $selectClasses); // Run the query.
		
	while ($classes = mysqli_fetch_array($queryClasses, MYSQLI_ASSOC)){ ?>

		<a class="class" href="edit_class.php?id=<?php echo $classes['class_id']; ?>">
	
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
		}	

?>
	</div>	
</div>
</div>
<?php include ('./footer.php'); ?>