<?php # Script 12.12 - login.php #4


include ('./header.php');
require ('./mysqli_connect.php'); 
require ('./user.php');

?>
<div class="row">
	<div class="grid_12">
		<div id="container">
		<?php

		$UserInfo = new User; 

		$selectClasses 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body FROM `ac2292777_personal_classes`";		
		$queryClasses	= @mysqli_query ($dbc, $selectClasses); // Run the query.
		
	while ($classes = mysqli_fetch_array($queryClasses, MYSQLI_ASSOC)){ 

			$parent_subject_id 			= $classes['parent_subject_id'];
			$selectSubCategories 		= "SELECT title FROM `$tablename`.`ac2292777_personal_subcategories` WHERE subcategory_id = $parent_subject_id";
			$querySubCategories			= @mysqli_query ($dbc, $selectSubCategories); // Run the query.
			$subCategories 				= mysqli_fetch_array($querySubCategories,MYSQLI_ASSOC);

?>
		<a class="element alkaline-earth metal" href="view_class.php?id=<?php echo $classes['class_id']; ?>">
			<img src="./usr/<?php echo $classes['user_id']; ?>/<?php echo $classes['class_id']; ?>/280x150_Header.jpg" alt="">
	
<!--       <p class="number">20</p>

 -->

 		<div class="titlearea">
       <h3 class = "title"><?php echo $classes['title']; ?></h3>
      	</div>
      	<h2 class="name">By: <?php echo $UserInfo->getInfo($classes['user_id'],"fullname",$dbc); ?> on <?php echo $classes['date_created']; ?></h2>

	</a>

			<?php 
		}		 ?>	
</div>

	</div>


</div>
<?php include ('./footer.php'); ?>