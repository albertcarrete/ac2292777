<?php if ($part == 1){?>
<form action="createsurvey.php" method="post" autocomplete="off">
	
	<input type="text" name="title" size="100" maxlength="100" placeholder="Question" autocomplete="off" value="<?php if (isset($_POST['Title'])) echo $_POST['Title']; ?>"/>
				<p>Enter a question</p>


	<div class="mainselection">
		<select name="ResponseType" id="input7">
			<option value="FreeResponse">Free Response</option>
			<option value="Dropdown">Dropdown</option>
			<option value="Checkbox">Checkbox</option>
		</select>
	</div>
	<p>Select a Response Type</p>
	<div class="clear"></div>
	<input type="submit" name="submit" value="Next" />
	<div class="clear"></div>	
</form>

<?php 
} else{ 
?>
<form action="createsurvey.php" method="post" autocomplete="off">

	<h4><?php echo $_SESSION['title']; ?></h4>
	<textarea name="Responses" size="100" maxlength="100" placeholder="Responses" autocomplete="off" value="<?php if (isset($_POST['Responses'])) echo $_POST['Responses']; ?>"/></textarea>
	<p>Enter reponses separated by commas</p>
	<div class="clear"></div>
	
	<input type="submit" name="submit" value="Create Survey" />
	<div class="clear"></div>	

</form>
<?php } ?>