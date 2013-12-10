<?php include ('./header.php'); ?>
<div class="class-view">
<div class="row">
	<div class="grid_8">
		<?php 

if (isset($_SESSION['user_id'])) { 

	// Check if user is able to edit this post

	// Required documentation
	require ('./mysqli_connect.php'); // Connect to the db.
  	require ('./login_functions.inc.php');


	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If POST request

  			$errors = array(); // Initialize an error array.

		  	if(empty($_POST['title'])){
   				$errors[] = "Title was left blank";
  			}
  			 else{
    			$title = mysqli_real_escape_string($dbc, trim($_POST['title']));    
  			}

 		  	if(empty($_POST['category'])){
   				$errors[] = "Category was left blank";
  			}
  			 else{
    			$category = mysqli_real_escape_string($dbc, trim($_POST['category']));    
  			}

  		  	if(empty($_POST['description'])){
   				$errors[] = "Description was left blank";
  			}
  			 else{
    			$description = mysqli_real_escape_string($dbc, trim($_POST['description']));    
  			}
   		  	if(empty($_POST['lesson'])){
   				$errors[] = "Lesson was left blank";
  			}
  			 else{
    			$lesson = mysqli_real_escape_string($dbc, trim($_POST['lesson']));    
  			}
  			$price = mysqli_real_escape_string($dbc, trim($_POST['price']));

			$user_id = $_SESSION['user_id'];
			$class_id = $_POST['class_id'];
			echo $class_id;
  	if (empty($errors)) { // If everything's OK.
		$classUpdate 	= "UPDATE `$tablename`.`ac2292777_personal_classes` SET parent_subject_id='$category',title ='$title',description = '$description',body ='$lesson',price = $price WHERE class_id='$class_id'";		
		$r = @mysqli_query ($dbc, $classUpdate); // Run the query.
    	   
    	   if ($r) { // If it ran OK.
    			echo "Class Updated";
    			redirect_user('managemyclasses.php');
    		}
    		else{
    			echo "could not run query!";
    		}
	}
	else{ ?>

	<!-- We ran into errors, refill the form and post errors -->
		<form class = "createclass" action="./edit_class.php" method="post">
          <div id="error_box_content" class="error">
	          <?php 
	            if (!empty($errors)) {
	    			foreach ($errors as $msg) { // Print each error.
	       			echo $msg."<br>";
	    			}  
	  			} ?>
          </div>
			<h4>Class Title</h4>
			<input id="title" name="title" type="text" size="20" maxlength="30" class="w-input input" autocomplete="off" placeholder="Untitled Class"value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"/>
          	<div class="half1">
          	<h4>Category</h4>
          	<input id="name"  name="category" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>">	
          	</div>
          	<div class="half2">
          	<h4>Price</h4>
          	<input id="name"  name="price" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>">	
          	</div>
          	<div class="clear"></div>
          	<h4>Description</h4>
          	<input id="name"  name="description" class="w-input input" type="text" placeholder=""  autocomplete="off" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>">
            <h4>Lesson</h4>
          	<textarea id="name"  name="lesson" class="w-input input" type="text" placeholder=""  autocomplete="off"><?php if (isset($_POST['lesson'])) echo $_POST['lesson']; ?></textarea>
          	<input  name="class_id" type="hidden" autocomplete="off" value="<?php echo $id;  ?>">

          	<input class="w-button submit" type="submit" value="SAVE CHANGES">
		</form>




<?php 
	}


	} //if POST
	else{ 
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

		?>




		<form class = "createclass" action="./edit_class.php" method="post">
          <div id="error_box_content" class="error">
	          <?php 
	            if (!empty($errors)) {
	    			foreach ($errors as $msg) { // Print each error.
	       			echo $msg."<br>";
	    			}  
	  			} ?>
          </div>
<?php

	//POPULATE THE FORM WITH EXISTING INFORMATION

	$user_id = $_SESSION['user_id']; 
	$selectClassToEdit 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body,price FROM `$tablename`.`ac2292777_personal_classes` WHERE class_id=$id";		
	$queryClassToEdit 	= @mysqli_query ($dbc, $selectClassToEdit);
	$class = mysqli_fetch_array($queryClassToEdit, MYSQLI_ASSOC);

?>

			<h4>Class Title</h4>
			<input id="title" name="title" type="text" size="20" maxlength="30" class="w-input input" autocomplete="off" placeholder="Untitled Class"value="<?php echo $class['title'];  ?>"/>
          	<div class="half1">
          	<h4>Category</h4>
          	<input id="name"  name="category" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php echo $class['parent_subject_id'];  ?>">	
          	</div>
          	<div class="half2">
          	<h4>Price</h4>
          	<input id="name"  name="price" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php echo $class['price'];  ?>">	
          	</div>
          	<div class="clear"></div>
            <h4>Description</h4>
          	<input id="name"  name="description" class="w-input input" type="text" placeholder=""  autocomplete="off" value="<?php echo $class['description'];  ?>">
            
            <h4>Lesson</h4>
          	<textarea id="name"  name="lesson" class="w-input input" type="text" placeholder=""  autocomplete="off"><?php echo $class['body']; ?></textarea>
          	<input  name="class_id" type="hidden" autocomplete="off" value="<?php echo $id;  ?>">
          	<input class="w-button submit" type="submit" value="SAVE CHANGES">
          	</form>
			<a class=" delete" href="./deleteclass.php?id=<?php echo $class['class_id'] ?>">DELETE</a>



	<?php }
}
?>
	</div>
</div>

</div>
<?php include ('./footer.php'); ?>