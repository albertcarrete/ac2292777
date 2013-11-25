<?php include 'header.php'; ?>
  <div class="sixteen columns content clearfix">

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

 // mysql_connect('localhost:8889', 'root', 'root');
  $tableName = "47924";
  //mysql_select_db($tableName);


//Query the database
  $query="SELECT  `instructor_id`       AS 'Instructor ID', 
                  `instructor_fn`       AS 'Instructor Firstname', 
                  `instructor_ln`       AS 'Instructor Lastname', 
                  `instructor_belt`     AS 'Instructor Belt', 
                  `instructor_contact`  AS 'Instructor Contact' 
  FROM `$tableName`.`ac2292777_entity_instructors` AS `ac2292777_entity_instructors`";

  $rs = mysql_query($query);
  ?>

<?php
// GATHER THE DATA POSTED 
if (isset($_POST["fname"]) && !empty($_POST["fname"])) {
  // Assign each POST to variable for SQL INSERT
  $firstname  = $_POST['fname'];
  $lastname   = $_POST['lname'];
  $belt       = $_POST['belt'];
  $contact    = $_POST['contact'];
  // Insert the queried values into our DB via 'INSERT INTO'
  $insert_query="INSERT INTO `ac2292777_entity_instructors` (`instructor_id`,`instructor_fn`,`instructor_ln`,`instructor_belt`,`instructor_contact`) 
        VALUES ";
  $insert_query.="('NULL'".","; // NULL is the appropriate auto-key value
  $insert_query.="'$firstname',";
  $insert_query.="'$lastname',";
  $insert_query.="'$belt',";
  $insert_query.="'$contact')";

  $ls = mysql_query($insert_query);
} ?> <!--  END IF -->

<?php
 $final_query="SELECT   `instructor_id`       AS 'Instructor ID', 
                        `instructor_fn`       AS 'Instructor Firstname', 
                        `instructor_ln`       AS 'Instructor Lastname', 
                        `instructor_belt`     AS 'Instructor Belt', 
                        `instructor_contact`  AS 'Instructor Contact' 
  FROM `$tableName`.`ac2292777_entity_instructors` AS `ac2292777_entity_instructors`";

?>
  <?php
  if ($_GET['sort'] == 'id'){
    $final_query .='ORDER BY instructor_id';
  }
  elseif ($_GET['sort'] == 'firstname'){
    $final_query .='ORDER BY instructor_fn';
  }
  elseif ($_GET['sort'] == 'lastname'){
    $final_query .='ORDER BY instructor_ln';
  }
  elseif ($_GET['sort'] == 'belt'){
    $final_query .='ORDER BY instructor_belt';
  }
  elseif ($_GET['sort'] == 'contact'){
    $final_query .='ORDER BY instructor_contact';
  }
    $query .=";";

        $rs = mysql_query($final_query);
  /* #Display the Database
  ================================================== */        
        echo "<table class='data'>";
		    echo "<tr><th>".'<a href="?sort=id">Instructor ID</a>'."</th>";
            echo "<th>".'<a href="?sort=firstname">Instructor Firstname</a>'."</th>";
            echo "<th>".'<a href="?sort=lastname">Instructor Lastname</a>'."</th>";
            echo "<th>".'<a href="?sort=belt">Instructor Belt</a>'."</th>";
            echo "<th>".'<a href="?sort=contact">Instructor Contact</a>'."</th></tr>";

        while($re = mysql_fetch_array($rs)){
                  echo "<tr><td>".$re['Instructor ID']."</td>";
                  echo "<td>".$re['Instructor Firstname']."</td>";
                  echo "<td>".$re['Instructor Lastname']."</td>";
                  echo "<td>".$re['Instructor Belt']."</td>";
                  echo "<td>".$re['Instructor Contact']."</td></tr>";
        }
?>

<!-- #Submit to the Database
  ================================================== -->
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
  <?php
  echo "<tr><td><input type='submit' value='Add Instructor'></td>";
  echo "<td><input type='text' name='fname'></td>";
  echo "<td><input type='text' name='lname'></td>";
  // echo "<td><input type='text' name='inst'></td>";
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
  echo "</td>";
  echo "<td><input type='text' name='contact'></td></tr>";
  echo "</form>";
  echo "</table>";


  if(! $rs )
{
  die('Could not enter data: ' . mysql_error());
}
?>
<p>Entered: <?php echo $_POST["fname"]; ?> / <?php echo $_POST["lname"]; ?> / <?php echo $_POST["inst"]; ?> / <?php echo $_POST["belt"]; ?><br></p>
</div>
<?php include 'footer.php'; ?>
