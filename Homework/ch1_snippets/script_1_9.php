<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Script 1.9 - Constants</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<?php 
		//Setting todays date as a constant
		define('TODAY', 'September 9, 2013');
		echo '<p>Today is ' . TODAY . '<br /> This server is running version <b>' . PHP_VERSION . '</b> of PHP on the <b>' . PHP_OS . '</b> operating system.</p>';
	?>
</body>
</html>