<?php include 'header.php'; ?>
  <div class="sixteen columns content clearfix">
<?php include "nav-admin.php"; ?>


<?php
  
  include 'connector.php';
  //mysql_connect('localhost:8889', 'root', 'root');
  $tableName = "47924";
  //mysql_select_db($tableName);

  /* #Query the Database
  ================================================== */
  // Selecting the items we need to pull.
  $query = "SELECT  `student_id`    AS 'Student ID', 
                    `student_fn`    AS 'Student Firstname', 
                    `student_ln`    AS 'Student Lastname', 
                    `student_inst`  AS 'Student Instructor', 
                    `student_belt`  AS 'Student Belt' 
  /* The Database we are pulling from */                    
  FROM `$tableName`.`ac2292777_entity_students` AS `ac2292777_entity_students` ";
    
  $rs = mysql_query($query);
?>


<?php
// GATHER THE DATA POSTED 
if (isset($_POST["fname"]) && !empty($_POST["fname"])) {
  // Assign each POST to variable for SQL INSERT
  $firstname  = $_POST['fname'];
  $lastname   = $_POST['lname'];
  $instructor = $_POST['inst'];
  $belt       = $_POST['belt'];

  // Insert the queried values into our DB via 'INSERT INTO'
  $insert_query="INSERT INTO `ac2292777_entity_students` (`student_id`,`student_fn`,`student_ln`,`student_inst`,`student_belt`) 
        VALUES ";
  $insert_query.="('NULL'".","; // NULL is the appropriate auto-key value
  $insert_query.="'$firstname',";
  $insert_query.="'$lastname',";
  $insert_query.="'$instructor',";
  $insert_query.="'$belt')";

  $ls = mysql_query($insert_query);
    if (!$ls){
      die(mysql_error());
    }
} 
?> <!--  END IF -->


<?php
  $query_students = "SELECT  `student_id`    AS 'Student ID', 
                    `student_fn`    AS 'Student Firstname', 
                    `student_ln`    AS 'Student Lastname', 
                    `student_inst`  AS 'Student Instructor', 
                    `student_belt`  AS 'Student Belt' 
  /* The Database we are pulling from */                    
  FROM `$tableName`.`ac2292777_entity_students` AS `ac2292777_entity_students` ";

// checks whether or not a sort has been called and adds it to the query. 

if(isset($_GET['sort'])){

  if ($_GET['sort'] == 'student_id'){     // this property is named below under "Display the Database"
    $query_students .='ORDER BY student_id'; // this property is the name as found in the database
  }
  elseif ($_GET['sort'] == 'student_fn'){
    $query_students .='ORDER BY student_fn';
  }
  elseif ($_GET['sort'] == 'student_ln'){
    $query_students .='ORDER BY student_ln';
  }
  elseif ($_GET['sort'] == 'student_inst'){
    $query_students .='ORDER BY student_inst';
  }
  elseif ($_GET['sort'] == 'student_belt'){
    $query_students .='ORDER BY student_belt';
  }

}//ENDIF

  $query_students .=";";

  $qs = mysql_query($query_students);
    
  if (!$qs){
    die(mysql_error());
  }

  /* #Display the Database
  ================================================== */
  echo "<table class='data'>";
  echo "<tr><th>".'<a href="?sort=student_id">Student ID</a>'."</th>";
  echo "<th>".'<a href="?sort=student_fn">Student Firstname</a>'."</th>";
  echo "<th>".'<a href="?sort=student_ln">Student Lastname</a>'."</th>";
  echo "<th>".'<a href="?sort=student_inst">Student Instructor</a>'."</th>";
  echo "<th>".'<a href="?sort=student_belt">Student Belt</a>'."</th></tr>";

  while($le = mysql_fetch_array($qs)){
    echo "<tr><td class = 'student_id'>".$le['Student ID']."</td>";
    echo "<td class ='firstname'>".$le['Student Firstname']."</td>";
    echo "<td>".$le['Student Lastname']."</td>";
    echo "<td>".$le['Student Instructor']."</td>";
    echo "<td>".$le['Student Belt']."</td></tr>";
  }?>
<?php

  $instructors_query ="SELECT  `instructor_id`       AS 'Instructor ID', 
                  `instructor_fn`       AS 'Instructor Firstname', 
                  `instructor_ln`       AS 'Instructor Lastname', 
                  `instructor_belt`     AS 'Instructor Belt', 
                  `instructor_contact`  AS 'Instructor Contact' 
  FROM `$tableName`.`ac2292777_entity_instructors` AS `ac2292777_entity_instructors`";

  $rls = mysql_query($instructors_query);

?>



<!-- #Submit to the Database
  ================================================== -->
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
  <?php
  echo "<tr><td class='submitROW'><input type='submit' value='Add Student'></td>";
  echo "<td class='submitROW'><input type='text' name='fname'></td>";
  echo "<td class='submitROW'><input type='text' name='lname'></td>";
  // echo "<td><input type='text' name='inst'></td>";
  echo "<td class='submitROW'>";
  echo "<select name = 'inst'>";
  while($ble = mysql_fetch_array($rls)){
  echo "<option value='".$ble['Instructor Firstname'].$ble['Instructor Lastname']."'>".$ble['Instructor Firstname']." ".$ble['Instructor Lastname']."</option>";
  }
  echo "</select>";
  echo "</td>";

  echo "<td>";
  echo "<select name = 'belt'>
  <option value='White'>White</option>
  <option value='Yellow'>Yellow</option>
  <option value='Orange'>Orange</option>
  <option value='Green'>Green</option>
  <option value='Blue'>Blue</option>
  <option value='Purple'>Purple</option>
  <option value='Red'>Red</option>
  <option value='Brown'>Brown</option>
  <option value='Black 1st Degree'>Black 1st Degree</option>
  <option value='Black 2nd Degree'>Black 2nd Degree</option>
  <option value='Black 3rd Degree'>Black 3rd Degree</option>
  <option value='Black 4th Degree'>Black 4th Degree</option>
  <option value='Black 5th Degree'>Black 5th Degree</option>
  <option value='Black 6th Degree'>Black 6th Degree</option>
  <option value='Black 7th Degree'>Black 7th Degree</option>
  <option value='Black 8th Degree'>Black 8th Degree</option>
  <option value='Black 9th Degree'>Black 9th Degree</option>
  <option value='Black 10th Degree'>Black 10th Degree</option>

</select>";
  echo "</td></tr>";
  echo "</form>";
  echo "</table>";
?>



<?php 
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){


if(! $rs )
{
  die('Could not enter data: ' . mysql_error());
}

}
?>
<p>Entered: <?php echo $_POST["fname"]; ?> / <?php echo $_POST["lname"]; ?> / <?php echo $_POST["inst"]; ?> / <?php echo $_POST["belt"]; ?><br></p>
</div>

<?php include 'footer.php'; ?>
