<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Savings Balance - Results</title>
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
			<p><b>1) Create a form with inputs for a savings account balance, number of years and a range for interest rates such as 5 to 10%. Display a table that shows the balance by year for each interest rate.</b></p>
			<p>2)  Create a form that asks for the rows and columns of a multiplication tables.  Size a display for the multiplication that is one larger in rows and cols to show the headings for the table.</p>
		</div>
	</div>

	<div class="row">
	<?php

    //Retrieve the form values
	$actBal=$_GET["actBal"];
	$numYears=$_GET["numYears"];
	$IR1=$_GET["IR1"];
	$IR2=$_GET["IR2"];
	echo "<p>Calculating an account balance of <b>$".$actBal."</b> after <b>".$numYears." years</b> for interest rates from <b>".$IR1."%</b> to <b>".$IR2."%</b>.";

	//Using loops
	function save($p,$i,$n){
		$sav=$p;
		for($year=1;$year<=$n;$year++){
			$sav*=(1+$i);
		}
		return $sav;
	}

	// Input Data
	$account = array();
	for ($range = $IR1; $range <= $IR2;$range++){
		$temp = $actBal;
		for($year = 0; $year <=$numYears; $year++){
			if($year == 0){
				$account[$range][$year] = $temp;
			}
			else{
				$temp *= (1+($range/100));
				$account[$range][$year] = $temp;
			}

		}
	}
	// Output Data

	//YEAR COLUMN
	$str='<table>';
	$str.="<tr>";
	$str.="<th>YEAR</th>";

	for ($range = $IR1; $range <= $IR2;$range++){
		$str.="<th>".$range."%</th>";
	}

	$str.="</tr>";

	// IR COLUMNS
	for($year = 0; $year <=$numYears; $year++){
		$str.="<tr>";
		$str.="<td>".$year."</td>";

		for ($range = $IR1; $range <= $IR2;$range++){
			$str.="<td>".number_format($account[$range][$year],2)."</td>";
		}
	
		$str.="</tr>";
	}
	$str.="</table>";

	echo $str;
	$savings=array();

	echo $savings[0];

	?>
	</div>
</div>
	
</body>
</html>