<?php # Script 12.12 - login.php #4
include ('./header.php');

// Instantiate a new Panel class
$ImpartPanel = new Panel; 


// = = = = = = = = = = = = = 
// Check for a session user
// = = = = = = = = = = = = = 

if (isset($_SESSION['user_id'])) { 

	if ($_SESSION['isAdmin'] == 0){
		$ImpartPanel -> userPanel();
	}
	else{
		$ImpartPanel -> adminPanel();		
	}


} else {  // isset($_SESSION('user_id')) ?>

<!-- Unlogged State -->

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