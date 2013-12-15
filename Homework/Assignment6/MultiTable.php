<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Multiplication Tables</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="grid">
	<div class="row">
		<div class="c3">
			<h4>Albert Carrete</h4>
			<h5>Riverside City College</h5>
			<h5>Assignment 6</h5>
		</div>
		<div class="c6">
			<p>1) Create a form with inputs for a savings account balance, number of years and a range for interest rates such as 5 to 10%. Display a table that shows the balance by year for each interest rate.</p>
			<p><b>2)  Create a form that asks for the rows and columns of a multiplication tables.  Size a display for the multiplication that is one larger in rows and cols to show the headings for the table.</b></p>
		</div>
	</div>
	<div class="row">
		<?php
		$numRows=$_GET["numRows"];
		$numCols=$_GET["numCols"];

		$sum = array();
		echo "<p>Calculating <b>".$numRows."</b> rows and <b>".$numCols." colums</b>. ";

		for($row = 1;$row<=$numRows;$row++){
			for($col = 1;$col<=$numCols;$col++){
				$sum[$row][$col] = $col * $row;
			}
		}

	// OUTPUT
	$str='<table>';
	$str.="<tr>";
	for ($col = 0; $col <= $numCols;$col++){
		$str.="<th>".$col."</th>";
	}
	$str.="</tr>";

	for ($row = 1; $row <= $numRows;$row++){
	$str.="<tr>";

		$str.="<td class='grey'>".$row."</td>";

		for ($col = 1; $col <= $numCols;$col++){
			$str.="<td>".$sum[$row][$col]."</td>";

		}
		$str.="</tr>";

	}

	$str.="</table>";

echo $str;

		?>
	</div>
</div>	
</body>
</html>