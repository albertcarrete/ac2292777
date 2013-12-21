<?php 

	include ('./header.php');

?>

<div class="class-view">
	<div class="row">
		<div class="grid_8 offset_2">
<?php


	//	========================================================
	//		CHECK FOR CLASS ID
	//	========================================================

	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has been accessed in error.</p>';
		echo '</div>';
	}



if (isset($_SESSION['user_id'])) { 

	// Required documentation
	require ('./mysqli_connect.php'); // Connect to the db.
  	require ('./login_functions.inc.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If POST request

  		$errors = array(); // Initialize an error array.
		include( 'image.php');

		//	========================================================
		//		IMAGE UPLOAD & VALIDATION
		//	========================================================
	
		$max_file_size = 1024*200; // 200kb
		$valid_exts = array('jpeg', 'jpg', 'png', 'gif');

		// thumbnail sizes
		$sizes = array(100 => 100, 150 => 150, 280 => 150);

		if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {

			// Instantiate variables
			$user_id 	= $_SESSION['user_id'];
			$class_id 	= $id;
			$urm 		= "usr/".$user_id."/".$class_id."/";
			$urlMake 	= "usr/".$user_id."/".$class_id."/";
			echo $urlMake;

		 	if( $_FILES['image']['size'] < $max_file_size ){
    
    			$exist = is_dir($urlMake);

    			if(!$exist){
		   			mkdir("$urlMake",0700);
    			}

	    		// get file extension
	    		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

			    if (in_array($ext, $valid_exts)) {

			      	/* resize image */
			    	foreach ($sizes as $w => $h) {
			    		$files[] = resize($w, $h, $urm);
			      	}

			    } else {

			    	$errors[] = 'Unsupported file';

			    }

  			} else{

    			$error[] = 'Please upload image smaller than 200KB';
  			}

		} // end IF POST

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


			echo $class_id;
  	if (empty($errors)) { // If everything's OK.
		$classUpdate 	= "UPDATE `$tablename`.`ac2292777_personal_classes` SET parent_subject_id='$category',title ='$title',description = '$description',body ='$lesson',price = $price WHERE class_id='$class_id'";		
		$r = @mysqli_query ($dbc, $classUpdate); // Run the query.
    	   
    	   if ($r) { // If it ran OK.
    			echo "Class Updated";
    		}
    		else{
    			echo "could not run query!";
    		}
	}
	else{ ?>

	<!-- We ran into errors, refill the form and post errors -->
		<form class = "createclass" action="./edit_class.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
          <div id="error_box_content" class="error">
	          <?php 
	            if (!empty($errors)) {
	    			foreach ($errors as $msg) { // Print each error.
	       			echo $msg."<br>";
	    			}  
	  			} ?>
          </div>
          <?php 
    // if(isset($files)){
    //   foreach ($files as $image) {
    //     echo "<img class='img' src='{$image}' /><br /><br />";
    //   }
    // }

          ?>
                      <input type="file" name="image" accept="image/*" /><br>

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
          	
          	<input  name="class_id" type="hidden" autocomplete="off" value="<?php echo $id;  ?>"> <!-- class id to carry over -->

          	<input class="w-button submit" type="submit" value="SAVE CHANGES">
		</form>




<?php 
	}


	} //if POST
	else{ 	

?>




		<form class = "createclass" action="./edit_class.php?id=<?php echo $id; ?>" method="post"  enctype="multipart/form-data">
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
      <h4>Header Image</h4>

            <input type="file" name="image" accept="image/*" /><br>

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

?>