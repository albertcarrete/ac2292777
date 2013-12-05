<?php include ('./header.php'); ?>
	<div class="row">
		<div class="grid_12">
			<div class="info-container narrow top">	
	<div class="head">
		<a href="./"><h1>Surveyor</h1></a>
		<p>Survey Results</p>
	</div>
<?php 

	require ('./mysqli_connect.php'); 
	require ('./login_functions.inc.php');

	// Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has been accessed in error.</p>';
		echo '</div>';
		include ('./footer.php'); 
		exit();
	}
	// $q = "SELECT owner, title, responses,reg_date FROM `$tablename`.`ac2292777_survey_surveys` WHERE survey_id=$id";		
$responseTally = array();
$getResponses = "SELECT responses AS responsed,title FROM `$tablename`.`ac2292777_survey_surveys` WHERE survey_id=$id";	

	$re = @mysqli_query ($dbc, $getResponses);

	if (mysqli_num_rows($re) == 1) { // If there is only one of these surveys then we are good


		$row = mysqli_fetch_array ($re, MYSQLI_NUM);
		preg_match_all("/[^,\s][^\,]*[^,\s]*/", $row[0], $output_array);
		echo "<div class='subhead'><h3>";
		echo $row[1];
		echo "</h3></div>";


		// FIND TOTAL RESPONSES TO THIS SURVEY
		$totResps = "SELECT * FROM `$tablename`.`ac2292777_survey_responses` WHERE survey_id=$id";
			if($totResps){
				$qTotalResponses = @mysqli_query ($dbc, $totResps);	
				$numTotalResponses = mysqli_num_rows($qTotalResponses); // NUMBER OF TOTAL RESPONSES				
			}				

		$int = 0;
		foreach($output_array[0] as $value){
			$q = "SELECT * FROM `$tablename`.`ac2292777_survey_responses` WHERE survey_id=$id AND user_response='$value'";
			if($q){
				$r = @mysqli_query ($dbc, $q);
				$rows[$int] = mysqli_num_rows($r);
				// echo $id;
				// echo $value;
				// echo $rows[$int];	

				$percAccurate = ($rows[$int] / $numTotalResponses)*100;
				$percRounded = round($percAccurate,2);
				$percRoundedCSS = round($percAccurate,0);
				echo "<div class='bar'>";
    			echo "<div class='percentage' style='width:".$percRoundedCSS."%'><p>".$percRounded."% ".$value."</p></div>";
				echo "</div>";

				$int+=1;
			}
			else{
				echo "That's too bad";
				exit();
			}
		}
		echo "<div class='results'>";
		echo "<a class='result-button' href='./''>Return to Dashboard</a>";
				echo "<a class='result-button' href='./''>Favorite</a>";
				echo "<div class='clear'></div>";		
		echo "</div>";

	}
	else // something went wrong
	{

	}
mysqli_close($dbc);


?>
</div>
</div>
</div>
<?php include ('./footer.php'); ?>
