<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Issinryu Karate - Backend</title>
	
	<!-- StyleSheets -->
	<link rel="stylesheet" href="./css/base.css" type="text/css">
    <link rel="stylesheet" href="./css/amazium.css" type="text/css">
    <link rel="stylesheet" href="./css/layout.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
</head>
<body>

<?php 
session_start(); // Start the session. ?>
<div class="header">
<div class="row">
	<div class="grid_12">
	<div class="top-bar">
		<ul>
				<?php // Create a login/logout link:
					if (isset($_SESSION['user_id'])) {
						echo '<li>Logged in as '.$_SESSION['first_name'].$_SESSION['last_name']."</li>";

						if(($_SESSION['isAdmin'])>0){
							echo '<li>You are admin</li>';	
						}

						echo '<li><a class="contact" href="./logout.php">Logout</a></li>';
					} else {
						echo '<li><a class ="contact" href="login.php">Login</a></li>';
						echo '<li><a class = "contact" href="./signup.php">Sign Up</a></li>';
					}
				?>
		</ul>
	</div>
</div>
	<div class="grid_7">
			<img class="logo-header"src="./img/logo-header.png" alt="">		
	</div>
	<div class="grid_5 address">
			<h2 class="color">(760) 568 0961</h2>
			<h2 class="color2">Whispering Palms Cathedral City<!--  68225 Ramon Road --></h2>	
	</div>
	<div class="grid_12">
  		<div class="main-nav">
			<ul>
				<li><a href="./index.php">Home</a></li>
				<li><a href="./about.php">About</a></li>
				<li><a href="./bio.php">Bio</a></li>
				<li><a href="./terminology.php">Terms</a></li>
				<li><a href="./contact.php">Contact</a></li>

			</ul>
		</div>
	<?php 					if(($_SESSION['isAdmin'])>0){ ?>

		<div class="admin-bar">
			<ul>
				<li>
	          		<li><a href="./view_users.php">Users</a></li>			
			        <li><a href="./view_contacts.php">Contacts</a></li>
				
				</li>
			</ul>
			
		</div>	
<?php } ?>
	</div>




</div> <!-- end row-->
</div>