<?php include 'header.php'; ?>

<div class="row photos">
	<div class="grid_12">
		<h2 class="reg-header">Photos Page</h2>	
	</div>
		<div class="grid_10 offset_1">
		<?php
			for ($count=1; $count < 30; $count++) { ?>
			<a id="single_image" href="./img/gallery/photo<?php echo $count; ?>.jpg"><img src="./img/gallery/photo<?php echo $count; ?>.jpg" alt=""></a>
			<?php }

		 ?>
	</div>
</div>
<?php include 'footer.php'; ?>
