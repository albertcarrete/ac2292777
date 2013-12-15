<?php 
$debug=false;
if($debug == true){?>
<div class="debugHUD">
	<h4><?php echo $_SESSION['tempSurveyData']['title']; ?></h4>
	<h4><?php echo $_SESSION['tempSurveyData']['step']; ?></h4>

</div>
<?php } ?>


<?php 
if (!empty($errors)){

		foreach ($errors as $msg) { // Print each error.
			echo "<p class='error'> $msg</p>\n";
		}	
}
?>
<?php if(!isset($_SESSION['tempSurveyData']['step'])) {?>
			<form action="createsurvey.php" method="post" autocomplete="off">
					<div class="mainselection">
						<select name="SurveyType" id="input7">
						    <option value="Single">Single Question</option>
						    <option value="Multi">Multi-Question</option>
						</select>
					</div>
			<p>Select the type of survey</p>
				<div class="clear"></div>	

				<input type="submit" name="submit" value="Next" />
				<div class="clear"></div>	
			</form>




<?php } else{ ?>

<?php if ($_SESSION['tempSurveyData']['step'] == 1){?>
<form action="createsurvey.php" method="post" autocomplete="off">
	
	<input type="text" name="title" placeholder="Question" autocomplete="off" value="<?php if (isset($_POST['Title'])) echo $_POST['Title']; ?>"/>
				<p>Enter a question</p>


	<div class="mainselection">
		<select name="responseType" id="input7">
			<option value="SingleSelect">Single Select</option>
			<option value="MultiSelect">Multi Select</option>
			<option value="FreeResponse">Free Response</option>
		</select>
	</div>
	<p>Select a Response Type</p>
	<div class="clear"></div>
	<input type="submit" name="submit" value="Next" />
	<div class="clear"></div>	
</form>


<?php 
} 

if($_SESSION['tempSurveyData']['step'] == 2){ 
?>
<form action="createsurvey.php" method="post" autocomplete="off">

	<h4><?php echo $_SESSION['tempSurveyData']['title']; ?></h4>
	<textarea name="Responses" size="100" maxlength="100" placeholder="Responses" autocomplete="off" value="<?php if (isset($_POST['Responses'])) echo $_POST['Responses']; ?>"/></textarea>
	<p>Enter reponses separated by commas</p>
	<div class="clear"></div>
	
	<input type="submit" name="submit" value="Create Survey" />
	<div class="clear"></div>	

</form>



<?php } 

if($_SESSION['tempSurveyData']['step'] == 3){ 
?>
<form action="createsurvey.php" method="post" autocomplete="off">

	<h4><?php echo $_SESSION['tempSurveyData']['title']; ?></h4>
	<h5>Free Response</h5>

	<div class="clear"></div>
	

	<input type="submit" name="submit" value="Create" />
	<div class="clear"></div>	

</form>



<?php } 

if($_SESSION['tempSurveyData']['step'] == 5){ 
?>
		<div class="results">
			<h4>Survey Created Successfully</h4>
			<img src="./img/success.png" alt="">
			<a class="result-button" href="./">Dashboard</a>
			<a class ="result-button" href='./my_surveys.php'>My Surveys</a>
			<div class="clear"></div>
		</div>



<?php } 

 }?>