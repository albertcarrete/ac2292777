<?php 
//============================
//
//	createclass.php
//
//============================




	include ('./header.php');
	$submitted = false;

	if(isset($_SESSION['user_id'])){

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			require ('./mysqli_connect.php'); // Connect to the db.
			require ('./login_functions.inc.php');

			$errors = array();

			// CHECK TITLE
			if(empty($_POST['title'])){
				$errors[] = "Title was left blank";
			}
			else{
				$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
			}
			// 	CHECK CATEGORY
			if(empty($_POST['category'])){
          		$errors[] = "Category was left blank";
        	}
         	else{
          		$category = mysqli_real_escape_string($dbc, trim($_POST['category']));    
        	}
        	// CHECK DESCRIPTION
        	if(empty($_POST['description'])){
         		$errors[] = "Description was left blank";
        	}
         	else{
          		$description = mysqli_real_escape_string($dbc, trim($_POST['description']));    
        	}
        	// CHECK LESSON
        	if(empty($_POST['lesson'])){
          		$errors[] = "Lesson was left blank";
        	}
         	else{
          		$lesson = mysqli_real_escape_string($dbc, trim($_POST['lesson']));    
        	}

        	$user_id = $_SESSION['user_id'];

        	if (empty($errors)) { // If everything's OK.

        		$q = "INSERT INTO `$tablename`.`ac2292777_personal_classes` (user_id, parent_subject_id, title, description,date_created, body) VALUES ('$user_id', '1', '$title', '$description',NOW(),'$lesson' )";
        		$r = @mysqli_query($dbc,$q); // run the query

        		if($r){

        			echo "completed";

        		}
        		else{

        			"Could not run the query!";

        		}

        	} // end if(empty($errors))

		} //end if POST

	} //end if user_id is set

if($submitted == true){

}
else{ 

?>

<div class="row">
  <div class="grid_8 centered">
      <form class = "createclass" action="./createclass.php" method="post">
          <div id="error_box_content" class="error">

<?php 
            if (!empty($errors)) {
    			foreach ($errors as $msg) { // Print each error.
       				echo $msg."<br>";
    			}  
  			}
?>
          </div>
      <h4>Class Title</h4>
      <input id="title" name="title" type="text" size="50" maxlength="50" class="w-input input" autocomplete="off" placeholder="Untitled Class"value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"/>
            <h4>Category</h4>
            <input id="name"  name="category" class="w-input input" type="text" placeholder="" autocomplete="off" value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>">
            <h4>Description</h4>
            <input id="name"  name="description" class="w-input input" type="text" placeholder=""  autocomplete="off" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>">
            <h4>Lesson</h4>
            <textarea id="name"  name="lesson" class="w-input input" type="text" placeholder=""  autocomplete="off"><?php if (isset($_POST['lesson'])) echo $_POST['lesson']; ?></textarea>
            <input class="w-button submit" type="submit" value="CREATE">
      </form>
  </div>
</div>

	



<?php 
}
include ('./footer.php'); ?>




?>
