<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Script 1.7 - Concatention</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- This script will go over how to concatentate in PHP -->
</head>
<body>
	<?php
		$first_name = 'Albert';
		$last_name = 'Carrete';
		// Concatentation.
		$fullname = $first_name .' '. $last_name;

		$sport = 'Basketball';

		echo "<p> $fullname plays $sport.</p>"
	?>
</body>
</html>