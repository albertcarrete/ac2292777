<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Paycheck Calculations</title>
</head>

<body>
<?php
    //Retrieve the form values
	$payRate=$_GET["payRate"];
	$hoursWorked=$_GET["hoursWorked"];
	$dblTime=$_GET["dblTime"];
	$tplTime=$_GET["tplTime"];

	$timeHolder;

	//Calculate the Paycheck
	if($hoursWorked>$tplTime){
		$payCheck = ( ($hoursWorked - $tplTime)*(3*$payRate) );
		$payCheck += ( ($tplTime - $dblTime) * (2*$payRate) );
		$payCheck += ($dblTime * $payRate);
	}
	elseif($hoursWorked >$dblTime){
		$payCheck = ($dblTime - $hoursWorked) * (2*$payRate);
		$payCheck += ($hoursWorked - $dblTime) * $payRate;
		echo "Greater than double time!";
	}
	else{
			echo "Regular!";

		$payCheck = $hoursWorked * $payRate;
	}



	// $payCheck=$hoursWorked*$payRate;
	// if($hoursWorked>$dblTime){
	//    $payCheck+=($hoursWorked-$dblTime)*$payRate*2;
	// }
	// elseif($hoursWorked>$tplTime){
	//    $payChck+=($hoursWorked-$dblTime)*$payRate*2;
	// }

	//Re-Display the inputs
	echo "<p>Pay Rate = $$payRate/hr</p>";
	echo "<p>Hours Worked = $hoursWorked (hrs)</p>";
	echo "<p>Double time starts at $dblTime (hrs)</p>";
	echo "<p>Triple time starts at $tplTime (hrs)</p>";
	echo "<p>Pay Check = $$payCheck</p>";
	echo "<table><tr><th>Hours Worked</th><th>Paycheck Total</th></tr>";

	do{
		echo "<tr><td>";
		echo $hour;
		echo "</td>";
		echo "<td>";

		//Calculate the pay
		if($hour > $tplTime){
			$payCheckDyn = ( ($hour - $tplTime) * (3*$payRate) );
			$payCheckDyn += ( ($tplTime - $dblTime) * (2*$payRate) ); // Double Time
			$payCheckDyn += $dblTime * $payRate; //Regular Time

		}
		elseif($hour > $dblTime){
			$payCheckDyn = ($hour - $dblTime) * (2*$payRate); // Double Time
			$payCheckDyn += $dblTime * $payRate; // Regular Time

		}
		else{
			$payCheckDyn = $hour * $payRate;

		}


		echo "$".$payCheckDyn;
		echo "</td></tr>";
	}while(++$hour<=$hoursWorked);
	
	echo "</table>";

?>
</body>
</html>