<?php include ('./header.php');

?>
<div class="row">
	<div class="grid_12">
		<div class="info-container narrow top">	
			<div class="head">
				<div class="logo">
					<a href="./"><h1>Surveyor</h1></a>
				</div>
				<p>Create Survey as <?php echo $_SESSION['username']; ?></p>				
			</div> <!-- end head -->

<?php 

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//Required documents
	require ('./login_functions.inc.php');
	require ('./mysqli_connect.php');		

	if(!isset($_SESSION['tempSurveyData']['step'])) {
		$_SESSION['tempSurveyData']['step'] = 0;
	}





	$errors = array(); // Initialize an error array.

switch ($_SESSION['tempSurveyData']['step']) {
	case 0:
		if($_POST['SurveyType'] === 'Single'){
			$_SESSION['tempSurveyData']['step'] +=1;
		}
		break;
	case 1:
		if (empty($_POST['title'])){
			$errors[] = "Question was left empty!";
		}
		else{
			$_SESSION['tempSurveyData']['title'] 		= $_POST['title'];
			$_SESSION['tempSurveyData']['responseType'] = $_POST['responseType'];
			if($_SESSION['tempSurveyData']['responseType'] == 'FreeResponse'){
				$_SESSION['tempSurveyData']['step'] 		 = 3;
			}
			else{
				$_SESSION['tempSurveyData']['step'] 		+=1;
			}
		}
		break;	
	case 2:
		if (empty($_POST['Responses'])){
			$errors[] = "Responses was left empty!";
		}
		else{
			$title 			= $_SESSION['tempSurveyData']['title'];
			$responseType 	= $_SESSION['tempSurveyData']['responseType'];

			$owner 			= $_SESSION['username'];
			$responses 		= $_POST['Responses'];
			
			$q = "INSERT INTO `$tablename`.`ac2292777_survey_surveys` (owner, title, questions, responses,reg_date,response_type) VALUES ('$owner', '$title', '$title', '$responses', NOW(),'$responseType' )";			
			$r = @mysqli_query ($dbc, $q); 
			
			if ($r){
				$_SESSION['tempSurveyData']['step'] 		= 5;
			}
			else{
				$errors[] = "Something went wrong";
			}
			mysqli_close($dbc); // Close the database connection.

		}
		break;
	
	// Our Case where we have a free response, so no pre-set responses are required.
	case 3: 
		$title 			= $_SESSION['tempSurveyData']['title'];
		$responseType 	= $_SESSION['tempSurveyData']['responseType'];

		$owner 			= $_SESSION['username'];
		$responses 		= '';

		$q = "INSERT INTO `$tablename`.`ac2292777_survey_surveys` (owner, title, questions, responses,reg_date,response_type) VALUES ('$owner', '$title', '$title', '$responses', NOW(),'$responseType' )";			
			$r = @mysqli_query ($dbc, $q); 
			
			if ($r){
				$_SESSION['tempSurveyData']['step'] 		= 5;
			}
			else{
				$errors[] = "Something went wrong";
			}
			mysqli_close($dbc); // Close the database connection.
		break;


	default:
		# code...
		break;
}


	// if ($_SESSION['tempSurveyData']['step'] == 0){

	// }

	// elseif ($_SESSION['tempSurveyData']['step'] == 1){
	// 	if (empty($_POST['title'])){
	// 		$errors[] = "Question was left empty!";
	// 	}
	// 	else{
	// 		$_SESSION['tempSurveyData']['title'] 		= $_POST['title'];
	// 		$_SESSION['tempSurveyData']['responseType'] = $_POST['responseType'];
	// 		$$_SESSION['tempSurveyData']['step'] 		+=1;
	// 	}
	// }
	// elseif ($_SESSION['tempSurveyData']['step'] == 2){


	// }



}
	include('./surveysingle.inc.php');	

?>




		</div>
	</div>
</div>
<?php include ('./footer.php'); ?>