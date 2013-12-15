<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Form Feedback v2</title>
</head>
<body>
	<?php
	//Validate Name
	if (!empty($_REQUEST['name'])){
		$name = $_REQUEST['name'];
	}
	else{
		$name = NULL;
		echo '<p class="error">You forgot to enter your name!</p>';
	}
	//Validate Email
	if (!empty($_REQUEST['email'])){
		$email = $_REQUEST['email'];
	}
	else{
		$email = NULL;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}
	//Validate Comments
	if (!empty($_REQUEST['comments'])){
		$comments = $_REQUEST['comments'];
	}
	else{
		$comments = NULL;
		echo '<p class="error">You forgot to enter your comments!</p>';
	}
	//Validate the Gender
		if (isset($_REQUEST['gender'])){
			$gender = $_REQUEST['gender'];
		}
		else{
			$gender=NULL;
		}

		if($gender == 'M'){
			echo '<p><b>Good day, Sir!</b></p>';
		}
		elseif($gender == 'F'){
			echo '<p><b>Good day, Madam!</b></p>';
		}
		else{
			echo '<p><b>No gender entered!</b></p>';
		}

		if ($name && $email && $gender && $comments){
			echo"<p>Thank you, <b>$name</b>, for the following comemnts:<br /><tt>$comments</tt></p> <p>We will reply to you at <i>$email</i></p>\n";
		}
		else{ // Missing form value.
			echo '<p class ="error">Please go back and fill out the form again.</p>';
		}
	
	?>
</body>
</html>