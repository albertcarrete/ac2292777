<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Impartly</title>
	
	<!-- StyleSheets -->
	<link rel="stylesheet" href="./css/base.css" type="text/css">
    <link rel="stylesheet" href="./css/amazium.css" type="text/css">
    <link rel="stylesheet" href="./css/layout.css" type="text/css">

    <link rel="stylesheet" href="./css/style.css" type="text/css">

		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
		<noscript><link rel="stylesheet" type="text/css" href="css/noJS.css" /></noscript>    
</head>
<body>

<?php

  $page = basename($_SERVER['REQUEST_URI']);
    if ($page == 'index.php' || $page == "/" || $page == '' || $page=='Survey') {
		ini_set('session.gc_maxlifetime',5);
		ini_set('session.gc_probability',1);
		ini_set('session.max_lifetime',5);

    }
    else{

    }
session_start(); ?>
<?php 
$debug=false;
	if($debug == true){
		echo "<div class = 'debugHUD'>";
		echo "session.gc_maxlifetime = ".ini_get("session.gc_maxlifetime");
		echo $_SESSION['email']."<br>";	
		echo $_SESSION['username']."<br>";
		echo $_SESSION['user_id'];

		echo "</div>";
	}
$showHeader = true;
$jem = basename($_SERVER['REQUEST_URI']);
    if ($jem == 'logout.php') {
    	$showHeader = false;
    }
    else{
    	$showHeader = true;
    }

if (isset($_SESSION['user_id']) && $showHeader ==true) {

	$cartsize = sizeof($_SESSION['cart']);

 ?>

<div class="header">
	<div class="row unhidden">
		<div class="grid_4">
			<a href="./index.php"><img src="./images/logo-sml.png" alt=""></a>

		</div>
<div class="offset_4 grid_1">
						<a class="cart" href="view_cart.php">
							<img src="./images/cart.png" alt="">
							<span class="quantity-cart"><?php echo $cartsize; ?></span>
						</a>	
</div>
		<div class="grid_3">
<div class="wrapper-demo">
						<div id="dd" class="wrapper-dropdown-5" tabindex="1"><?php echo $_SESSION['username']; ?>
						<ul class="dropdown">
							<li><a href="./createclass.php"><i class="icon-user"></i>Create a class</a></li>
							<li><a href="./managemyclasses.php"><i class="icon-user"></i>Manage classes</a></li>
							<li><a href="./settings.php"><i class="icon-cog"></i>Settings</a></li>
							<li><a href="./logout.php"><i class="icon-remove"></i>Log out</a></li>
						</ul>
					</div>
</div>
<!-- 			<nav>
				<ul>
					<li><a href="./index.php">Home</a></li>
					<li><a href="./categories.php">My Classes</a></li>
					<li><a href="./createclass.php">Create a Class</a></li>
					<li><a href="./settings.php">Settings</a></li>
					<li>
						<span class="bold">acarrete</span>
						<a class="cart" href="view_cart.php">
							<img src="./images/cart.png" alt="">
							<span class="quantity-cart"><?php echo $cartsize; ?></span>
						</a>
					</li>
				</ul>
			</nav> -->
		</div>
	</div>	
</div>
<?php } ?>