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
		echo $_SESSION['username'];
		echo "</div>";
	}

?>

<div class="header">

</div>