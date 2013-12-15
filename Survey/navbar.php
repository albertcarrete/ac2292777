		<div class="grid_12">
			<div class="info-container wide top">	
				<div class="head">
					<div class="logo">
					<a href="./"><h1>Surveyor</h1></a>
					</div>
<?php if($_SESSION['isAdmin'] > 0){ ?>
					<div class="nav user">
						<ul>
							<li><a href="./">Dashboard</a></li>
							<li><a href="./my_surveys.php">Edit Surveys</a></li>
							<li><a href="./view_users.php">Edit Users</a></li>
							<li><a href="./settings.php">Settings</a></li>
						</ul>
					</div>
	<?php }
	else{ ?>
					<div class="nav user">
						<ul>
							<li><a href="./">Dashboard</a></li>
							<li><a href="./createsurvey.php">Create Survey</a></li>
							<li><a href="./my_surveys.php">My Surveys</a></li>
							<li><a href="./settings.php">Settings</a></li>
						</ul>
					</div>
	<?php } ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>