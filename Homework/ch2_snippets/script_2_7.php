<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Multidimensional Arrays</title>
</head>
<body>
	<?php 
		#Script 2.7 - multi

		// Create one array:
		$mexico = array(
		'YU'=>'Yucatan',
		'BC'=> 'Baja California',
		'OA' => 'Oaxaca'
		);
		// Create a second array
		$us = array(
		'MD'=>'Maryland',
		'IL'=> 'Illinois',
		'PA' => 'Pennsylvania',
		'IA' => 'Iowa'
		);


		// Create a third array
		$canada = array(
		'QC'=>'Quebec',
		'AB'=> 'Alberta',
		'NT' => 'Northwest Territories',
		'YT' => 'Yukon',
		'PE' => 'Prince Edward Island'
		);

		// Loop through the all the countries created:
		$n_america = array(
			'Mexico' => $mexico,
			'United States' => $us,
			'Canada' => $canada

			);
		// Loop through the countries and combine them

		foreach ($n_america as $country => $list){
			// Heading
			echo "<h2>$country</h2><ul>";
			//Print each state, province or territory
			foreach ($list as $k => $v){
				echo "<li>$k - $v</li>\n";
			}
			echo '</ul>';
		}

	?>
</body>
</html>