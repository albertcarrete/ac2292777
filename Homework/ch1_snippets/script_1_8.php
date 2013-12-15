<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Script 1.8 - Numbers</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<?php
		// Numbers
		$quantity = 30; // Buying 30 items
		$price = 119.95;
		$taxrate = 0.5; // 5% sales tax

		$total = $quantity * $price;
		$total = $total + ($total * $taxrate);
		// Calculate and add sales tax

		$total = number_format ($total, 2);

		echo '<p> You are purchasing <b>' . 
		$quantity . '</b> item(s) at a cost of <b> $' . 
		$price . '</b> each. With tax, the total comes to <b> $' .
		$total . '</b>. </ p >';

?>
</body>
</html>