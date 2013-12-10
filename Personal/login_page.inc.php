<?php include ('./header.php'); ?>
  <div class="row"> 
    <div class="grid_12">
      <a href="./index.php"><img class="logo" src="./images/logo.png" alt=""></a>
    <form id="loginformform" class="w-clearfix form" action = "./login.php" method ="post" autocomplete = "off">
          <div id="error_box_content" class="error"></div>
          <input id="email" name="email" class="w-input input" type="text" placeholder="Email" autocomplete="off" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
          <input id="password" name="pass" class="w-input input" type="password" placeholder="Password" autocomplete="off">
          <input class="w-button submit" type="submit" value="LOG IN">
        
          <div class="rememberme"><div id="rememberMe" class="checked"></div>Remember me</div>
          <a class="link" href="/users/login/recover">I forgot my Password</a>
            <a class="button2" href="./register.php">Don't have an account? Sign up now!</a>
      </form>

          </div>
  </div>
<?php include ('./footer.php'); ?>
