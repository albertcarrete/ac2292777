<?php include ('./header.php'); ?>

<?php # Script 12.12 - login.php #4
// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security.

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Need two helper files:
  require ('./mysqli_connect.php'); 
  require ('./login_functions.inc.php');

  echo $_POST['email'];

  $tablename = '47924';
    
  // Check the login:
  list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
  
  if ($check) { // OK!
    ini_set('session.gc_maxlifetime',5);
    ini_set('session.gc_probability',1);
    // Set the session data:
    $_SESSION['user_id']      = $data['user_id'];
    $_SESSION['username']     = $data['username'];
    $_SESSION['email']        = $data['email'];
    $_SESSION['first_name']   = $data['first_name'];
    $_SESSION['last_name']    = $data['last_name'];
    $_SESSION['isAdmin']      = $data['isAdmin'];
    $_SESSION['cart'][0][0];

    // Store the HTTP_USER_AGENT:
    $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

    // Redirect:
    redirect_user('index.php');
      
  } else { // Unsuccessful!
    echo "<p> could not find user</p>";
    // Assign $data to $errors for login_page.inc.php:
    $errors = $data;

    foreach($data as $msg){
    echo $msg;

    }

  }
    
  mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('./login_page.inc.php');
?>