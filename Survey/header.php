<?php

if(!isset($_SESSION)){

    session_start();
}

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Surveyor</title>
	
	<!-- StyleSheets -->
	<link rel="stylesheet" href="./css/base.css" type="text/css">
    <link rel="stylesheet" href="./css/amazium.css" type="text/css">
    <link rel="stylesheet" href="./css/layout.css" type="text/css">
</head>
<body>

<?php

  $page = basename($_SERVER['REQUEST_URI']);
    if ($page == 'index.php' || $page == "/" || $page == '' || $page=='Survey') {
    }
    else{

    }
 ?>
<?php 

	$debug=false;
	if($debug == true){
		echo "<div class = 'debugHUD'>";

		if (isset($_SESSION['username'])){
			echo "Current User: ".$_SESSION['username'];
		}
		else{
			echo "No user logged in";
		}
		echo "</div>";
	}

?>

<div class="header">

</div>