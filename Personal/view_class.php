<?php include ('./header.php');


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
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if($_POST['cart_action'] == 'add'){
			$_SESSION['cart'][$id] = $id;
		}

		if($_POST['cart_action'] == 'remove'){
			unset($_SESSION['cart'][$id]);
		}
		// echo $_SESSION['cart']['$id'];
		// print_r($_SESSION['cart']);
	}

	$selectClass 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body,video,price FROM `$tablename`.`ac2292777_personal_classes` WHERE class_id=$id";		
	$queryClass		= @mysqli_query ($dbc, $selectClass); // Run the query.
	

	$class = mysqli_fetch_array($queryClass, MYSQLI_ASSOC);
	$matchfound = false;
		if($class){
			$matchfound = true;
		}
		else{
			$matchfound = false;
		}
 ?>
<div class="class-page">
<div class="row">
	<div class="grid_11 offset_1">
		<div class="entry">
			<div class="head">
			<h2><?php echo $class['title'];?></h2>
			</div>
		</div>
	</div>
	<div class="grid_7 offset_1">
		<div class="content">
		<?php if ($matchfound == true){

			$user_id = $class['user_id'];

			$selectUser 	= "SELECT first_name,last_name FROM `$tablename`.`ac2292777_personal_users` WHERE user_id=$user_id";		
			$queryUser		= @mysqli_query ($dbc, $selectUser); // Run the query.			
			$user 			= mysqli_fetch_array($queryUser, MYSQLI_ASSOC);



			?>
		<div class="entry">
			<?php if($class['video']){ ?>
			<div class="videowrapper">
				<iframe width="100%" height="400px" src="//www.youtube.com/embed/<?php echo $class['video']; ?>" frameborder="0" allowfullscreen></iframe>
			</div>
			<?php } ?>
			<blockquote><?php echo $class['description'];?></blockquote>
			<p><?php echo $class['body'];?></p>


		</div>
		<?php }else{ ?>
		<div class="entry">
			<h3>This page has been accessed in error</h3>
		</div>
<?php } ?>

</div>
	</div>
	<div class="grid_4">
		<div class="entry">
			<div class="content">
<div id="listing-buy-module">
<form action="./view_class.php" method="post">
	<?php if (isset($_SESSION['cart'][$id])){ ?>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="cart_action" value="remove" />
    <input class="btn-enroll btn green small ga-event" type="submit" value="Remove from Cart">	
	<?php }else{ ?>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="cart_action" value="add" />
    <input class="btn-enroll btn green small ga-event" type="submit" value="Add to Cart">
    <?php } ?>
</form>
		</div> 
		<div class="course-detail">
			<div class="course-detail-overview">
			<div class="course-detail-info">
				<div class="course-detail-created item">
					<span class="label">Price:</span> $<?php echo $class['price']; ?>
				</div>
				<div class="course-detail-created item">
					<span class="label">Created:</span> <?php echo $class['date_created']; ?>
				</div>
				<div class="course-detail-created item">
					<span class="label">Author:</span> <?php echo $user['first_name'].' '.$user['last_name']; ?>
				</div>
				<div class="course-detail-created item">
					<span class="label">Class Starts:</span> 12/20/13
				</div>
			</div>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>
</div>
<?php include ('./footer.php'); ?>