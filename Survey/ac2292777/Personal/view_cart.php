<?php include ('./header.php');
	require ('./mysqli_connect.php'); 
	require ('./login_functions.inc.php');
?>
<div class="class-page">
	<div class="row">
		<div class="grid_8 offset_2">
			<div class="order">
			<h2>Review Your Cart</h2>
			<table>
				<tr>
					<th>Class</th>
					<th>Price</th>
				</tr>
			<?php 	
			// CREATE OUR WHERE STATEMENT
			$isFirst = true;
			foreach ($_SESSION['cart'] as $classID){

				if($isFirst){
					$whereQuery="class_id="."'".$classID."'";
				}
				else{
					$whereQuery.=" OR class_id="."'".$classID."'";
				}
				$isFirst = false;
			}


			$selectClasses 	= "SELECT class_id,user_id,parent_subject_id,title,description,date_created,body,price FROM `$tablename`.`ac2292777_personal_classes` WHERE $whereQuery";		
			$queryClasses	= @mysqli_query ($dbc, $selectClasses); // Run the query.
			$total = 0;
			while ($classes = mysqli_fetch_array($queryClasses, MYSQLI_ASSOC)){ ?>
				<tr>
					<td><?php echo $classes['title']; ?></td>
					<td>$<?php echo $classes['price']; ?></td>
					<?php (float)$total += $classes['price']; ?>
				</tr>
			<?php }

			?>


			</table>
			<div class="total">Total: $<?php echo (float)$total; ?></div>

			</div>

		</div>
	</div>
</div>
<?php include ('./footer.php'); ?>