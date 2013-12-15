<?php include ('./header.php'); ?>
<?php # Script 9.5 - register.php #2
    // This script performs an INSERT query to add a record to the users table.

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require ('./mysqli_connect.php'); // Connect to the db.
  require ('./login_functions.inc.php');

  $errors = array(); // Initialize an error array.

  //Regular Expressions
  $regexName = "/^[a-zA-z]{1,19}$/";
  $regexEmail = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";

  $usernameCheck = $_POST['username'];

  if(empty($_POST['username'])){
    $errors[] = "Username field was blank";
  }
  elseif(!preg_match($regexName,$usernameCheck)){
    $errors[] = 'Insert a valid username';

  }
  else{
    $un = mysqli_real_escape_string($dbc, trim($_POST['username']));    
  }

  $firstnameCheck = $_POST['first_name'];

  // Check for a first name:
  if (empty($_POST['first_name'])) {
    $errors[] = 'Firstname was left blank.';
  }
  elseif(!preg_match($regexName,$firstnameCheck)){
    $errors[] = 'Insert a valid first name';
  }
   else {
    $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
  }
  
  $lastnameCheck = $_POST['last_name'];
  // Check for a last name:
  if (empty($_POST['last_name'])) {
    $errors[] = 'Last name was left blank.';
  }
  elseif(!preg_match($regexName,$lastnameCheck)){
    $errors[] = 'Insert a valid last name.';
  }
   else {
    $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
  }
  $emailCheck = $_POST['email'];
  echo $_POST['email'];
  // Check for an email address:
  if (empty($_POST['email'])) {
    $errors[] = 'Email was left blank.';
  }
  elseif(!preg_match($regexEmail,$emailCheck)){
    $errors[] = 'Insert a valid email address';
  }
   else {
    $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
  }
  
  // Check for a password and match against the confirmed password:
  if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
      $errors[] = 'Your passwords do not match';
    } else {
      $p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
    }
  } else {
    $errors[] = 'Password was left blank.';
  }
  $isA = 0;
  $isL = 0;
  
  if (empty($errors)) { // If everything's OK.
  
    // Register the user in the database...
    
    // Make the query:
    $q = "INSERT INTO `$tablename`.`ac2292777_personal_users` (username, first_name, last_name, email, pass, isAdmin, isLoggedIn, registration_date) VALUES ('$un', '$fn', '$ln', '$e', SHA1('$p'),'$isA', '$isL', NOW() )";    
    // $q = "INSERT INTO `$tablename`.`ac2292777_karate_users` (username, first_name, last_name, email, pass, isAdmin, isLoggedIn, registration_date)
    //      VALUES (`test`, `test`, 'tester', `test@gmail.com`, SHA1('rofl'),'0', '0', NOW() )";    
    
    $r = @mysqli_query ($dbc, $q); // Run the query.
    if ($r) { // If it ran OK.
    
      // Print a message:
          redirect_user('login.php');

      ?>
    
    <?php
    } else { // If it did not run OK.
      
      // Public message:
      echo '<h1>System Error</h1>
      <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
      
      // Debugging message:
      echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
            
    } // End of if ($r) IF.
    
    mysqli_close($dbc); // Close the database connection.

    // Include the footer and quit the script:
    exit();
    
  } else { // Report the errors.
    // echo '<h1>Error!</h1>';

  } // End of if (empty($errors)) IF.
  
  mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
  <div class="row"> 
    <div class="grid_12">
      <a href="./index.php"><img class="logo" src="./images/logo.png" alt=""></a>
    <form id="loginformform" class="w-clearfix form" name="email-form" action="register.php" method="post" autocomplete="off">
          <div id="error_box_content" class="error">

          <?php 
            if (!empty($errors)) {
    foreach ($errors as $msg) { // Print each error.
       echo $msg."<br>";
    }  
  }
  ?>
          </div>
          <input id="username" name="username" type="text" size="20" maxlength="30" class="w-input input" autocomplete="off" placeholder="Username"value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"/>
          
          <input id="name"  name="first_name" class="w-input input" type="text" placeholder="First Name" autocomplete="off" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
          <input id="name"  name="last_name" class="w-input input" type="text" placeholder="Last Name"  autocomplete="off" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
          <input id="email" name="email" class="w-input input" type="text" placeholder="Email"      autocomplete="off" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">

          <input type="password" name="pass1" class="w-input input" size="20" maxlength="20" placeholder="Pass" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"/>
          <input type="password" name="pass2" class="w-input input" size="20" maxlength="20" placeholder="Pass Verify" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" />

          <input class="w-button submit" type="submit" value="REGISTER">
        
            <a class="button2" href="./login.php">Already have an account? Login now!</a>
      </form>
<?php 

?>
          </div>
  </div>
<?php include ('./footer.php'); ?>
