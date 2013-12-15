<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Form Feedback</title>
</head>
<body>
	<?php 

		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$comments = $_REQUEST['comments'];

		echo"<p>Thank you, <b>$name</b>, for the following comemnts:<br /><tt>$comments</tt></p> <p>We will reply to you at <i>$email</i></p>\n";
	
	?>
</body>
</html>