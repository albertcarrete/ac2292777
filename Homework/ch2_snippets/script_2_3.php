<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Form Feedback v2</title>
</head>
<body>
	<?php 
		//Create the $gender variable
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
	?>
</body>
</html>