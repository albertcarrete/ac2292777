<?php include 'header.php'; ?>
			<nav class="main-nav">
				<ul id="list-nav-2">
					<li><a href="./students.php">Students</a></li>
					<li><a href="./teachers.php">Teachers</a></li>
				</ul>
			</nav>

<?php
  // CONNECT TO THE DATABASE
  // Create a connection to the database
  // DB, UN, Pass, DB
  mysql_connect('209.129.8.3', '47924', '47924cis12');
  mysql_select_db('47924');

  //mysql_connect('localhost', '47924', '47924cis12');
  //mysql_select_db('47924');


  /* #Query the Database
  ================================================== */
  // Selecting the items we need to pull.
  $query = "SELECT  `student_id`    AS 'Student ID', 
                    `student_fn`    AS 'Student Firstname', 
                    `student_ln`    AS 'Student Lastname', 
                    `student_inst`  AS 'Student Instructor', 
                    `student_belt`  AS 'Student Belt' 
  /* The Database we are pulling from */                    
  FROM `47924`.`ac2292777_entity_students` AS `ac2292777_entity_students` ";
    
  /* Checks whether a sort query has been called*/

  if ($_GET['sort'] == 'student_id'){  // this property is named below under "Display the Database"
    $query .='ORDER BY student_id'; // this property is the name as found in the database
  }
  elseif ($_GET['sort'] == 'student_fn'){
    $query .='ORDER BY student_fn';
  }
  elseif ($_GET['sort'] == 'student_ln'){
    $query .='ORDER BY student_ln';
  }
  elseif ($_GET['sort'] == 'student_inst'){
    $query .='ORDER BY student_inst';
  }
  elseif ($_GET['sort'] == 'student_belt'){
    $query .='ORDER BY student_belt';
  }
    $query .=";";
  $rs = mysql_query($query);
?>


<?php include 'footer.php'; ?>