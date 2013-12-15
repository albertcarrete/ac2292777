<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>2.5 $_POSt</title>
	<!-- The superglobal variables, like $_POST here, 
	are just one type of array you'll use in PHP. -->
</head>
<body>

	<?php

		if (!empty ($_POST['name']) && !empty ($_POST['comments']) && !empty ($_POST['email'])){
			echo "<p>Thank you, <b>{$_POST['name']}</b>, for the following comments: <br/> <tt>{$_POST['comments']}</tt></p><p>We will reply to you at <i>{$_POST['email']}</i></p>\n";
		}else{
			echo '<p>Please go back and fill out the form again</p>';
		}

	?>
</body>
</html>