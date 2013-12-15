<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Script 1.5</title>
	<!-- This file will print three of PHP's many defined variables.  -->
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
	<?php
		$file = $_SERVER['SCRIPT_FILENAME'];
		$user = $_SERVER['HTTP_USER_AGENT'];
		$server = $_SERVER['SERVER_SOFTWARE'];
		
		// Print the name of this script:
		echo "<p>You are running the file:<br /><b>$file</b></p>\n";

		echo "<p>You are viewing this page using:<br /><b>$user</b></p>\n";
		
		echo "<p>This server is running:<br /><b>$server</b></p>\n";

	?>
</body>
</html>