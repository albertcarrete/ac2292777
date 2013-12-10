<?php include ('./header.php'); ?>
  <div class="row"> 
    <div class="grid_12">
      <img class="logo" src="./images/logo.png" alt="">
    <form id="loginformform" class="w-clearfix form" name="email-form" data-name="Email Form">
          <div id="error_box_content" class="error"></div>
          <input id="email" class="w-input input" type="text" placeholder="Email" name="email-adress" data-name="Email adress">
          <input id="password" class="w-input input" type="password" placeholder="Password" name="password" data-name="Password">
          <input class="w-button submit" type="submit" value="LOG IN" data-wait="LOGGING IN...">
        
          <div class="rememberme"><div id="rememberMe" class="checked"></div>Remember me</div>
          <a class="link" href="/users/login/recover">I forgot my Password</a>
            <a class="button2" href="/users/register">Don't have an account? Sign up now!</a>
      </form>

          </div>
  </div>
<?php include ('./footer.php'); ?>
