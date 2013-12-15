<?php include ('./header.php'); ?>
<div class="class-view">
<div class="row">
	<div class="grid_6 offset_3">
		<?php 

if (isset($_SESSION['user_id'])) { 

	// Check if user is able to edit this post

	// Required documentation
	require ('./mysqli_connect.php'); // Connect to the db.
  	require ('./login_functions.inc.php');


	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If POST request

  			$errors = array(); // Initialize an error array.

		  	if(empty($_POST['username'])){
   				$errors[] = "Username was left blank";
  			}
  			 else{
    			$username = mysqli_real_escape_string($dbc, trim($_POST['username']));    
  			}

 		  	if(empty($_POST['first_name'])){
   				$errors[] = "First name was left blank";
  			}
  			 else{
    			$first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));    
  			}

  		  	if(empty($_POST['last_name'])){
   				$errors[] = "Last name was left blank";
  			}
  			 else{
    			$last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));    
  			}
   		  	if(empty($_POST['email'])){
   				$errors[] = "Email was left blank";
  			}
  			 else{
    			$email = mysqli_real_escape_string($dbc, trim($_POST['email']));    
  			}

			$user_id = $_SESSION['user_id'];
			$class_id = $_POST['class_id'];

  	if (empty($errors)) { // If everything's OK.
		$classUpdate 	= "UPDATE `$tablename`.`ac2292777_personal_users` SET username='$username',first_name ='$first_name',last_name = '$last_name',email ='$email' WHERE user_id='$user_id'";		
		$r = @mysqli_query ($dbc, $classUpdate); // Run the query.
    	   
    	   if ($r) { // If it ran OK.
    			echo "Class Updated";
    			redirect_user('index.php');
    		}
    		else{
    			echo "could not run query!";
    		}
	}
	else{ ?>

	<!-- We ran into errors, refill the form and post errors -->
		<form class = "createclass" action="./settings.php" method="post">
          <div id="error_box_content" class="error">
	          <?php 
	            if (!empty($errors)) {
	    			foreach ($errors as $msg) { // Print each error.
	       			echo $msg."<br>";
	    			}  
	  			} ?>
          </div>
			<h4>Username</h4>
      <input id="title" name="username" type="text" size="20" maxlength="30" class="w-input input" autocomplete="off" value="<?php echo $user['username'];  ?>"/>
            <div class="half1">
            <h4>First Name</h4>
            <input id="name"  name="first_name" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php echo $user['first_name'];  ?>">  
            </div>
            <div class="half2">
            <h4>Last Name</h4>
            <input id="name"  name="last_name" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php echo $user['last_name'];  ?>">  
            </div>
            <div class="clear"></div>
            <h4>Email</h4>
            <input id="name"  name="description" class="w-input input" type="text" placeholder=""  autocomplete="off" value="<?php echo $user['email'];  ?>">
            
            <input  name="class_id" type="hidden" autocomplete="off" value="<?php echo $id;  ?>">
            <input class="w-button submit" type="submit" value="SAVE CHANGES">
            </form>




<?php 
	}


	} //if POST

	else{ 

		?>




		<form class = "createclass" action="./settings.php" method="post">
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
	$selectUserToEdit 	= "SELECT username,first_name,last_name,email FROM `$tablename`.`ac2292777_personal_users` WHERE user_id='$user_id'";		
	$queryUserToEdit 	= @mysqli_query ($dbc, $selectUserToEdit);
	$user = mysqli_fetch_array($queryUserToEdit, MYSQLI_ASSOC);

?>
        <h1>Edit User Details</h1>
			<h4>Username</h4>
			<input id="title" name="username" type="text" size="20" maxlength="30" class="w-input input" autocomplete="off" value="<?php echo $user['username'];  ?>"/>
          	<div class="half1">
          	<h4>First Name</h4>
          	<input id="name"  name="first_name" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php echo $user['first_name'];  ?>">	
          	</div>
          	<div class="half2">
          	<h4>Last Name</h4>
          	<input id="name"  name="last_name" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php echo $user['last_name'];  ?>">	
          	</div>
          	<div class="clear"></div>
            <h4>Email</h4>
          	<input id="name"  name="email" class="w-input input" type="text" placeholder=""  autocomplete="off" value="<?php echo $user['email'];  ?>">
            
          	<input  name="class_id" type="hidden" autocomplete="off" value="<?php echo $id;  ?>">
          	<input class="w-button submit" type="submit" value="SAVE CHANGES">
          	</form>


	<?php }
}
?>
	</div>
</div>

</div>
<?php include ('./footer.php'); ?>