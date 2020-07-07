<?php 
  session_start();
  include "inc/header.php";
?>
<body>
  <div class="container">
    <div class="main-form">
      <div class="login-form">
        <div class="header">
          <h2 class="title">Login</h2>
          <i class="fas fa-key" id="user-logo"></i>
        </div>
        <form method="POST" action="http://localhost:8080/PHP/Mini%20projects/PHP%20Login%20and%20Registration%20Form/processLogin.php">
          <?php
            if(isset($_SESSION["message"])) { ?>
              <div class="control-group">
                  <div class="main-login-log" style="display: block; background-color: var(--error-background); color: var(--error-color);"><?php echo $_SESSION["message"];?></div>
              </div>    
            <?php }

            else { ?>
              <div class="control-group">
                  <div class="main-login-log" style="display: none;"></div>
              </div>    
            <?php }
            session_destroy();
            session_abort(); 
            ?>

          <div class="control-group">
            <label for="login-username">Username or Email</label>
            <input
              type="text"
              id="login-username"
              name="login-username"
              placeholder="Enter username"
            />
            <div class="error" id="error-login-username"></div>
          </div>
          <div class="control-group">
            <label for="login-password">Password</label>
            <input
              type="password"
              id="login-password"
              name="login-password"
              placeholder="Enter password"
            />
            <div class="error" id="error-login-password"></div>
          </div>
          <button id="login" name="login-submit">Login</button>
        </form>
      </div>
      <div class="registration-form">
        <div class="header">
          <h2 class="title">Create an account</h2>
          <i class="fas fa-user-plus" id="user-logo"></i>
        </div>
        <form method="POST">
          <div class="control-group">
            <div class="main-log"></div>
          </div>
          <div class="control-group">
            <label for="register_username">Enter username</label>
            <input
              type="text"
              id="register-username"
              name="register-username"
              placeholder="Enter username"
            />
            <div class="error" id="error-register-username"></div>
          </div>
          <div class="control-group">
            <label for="register-email">Enter email</label>
            <input
              type="text"
              id="register-email"
              name="register-email"
              placeholder="Enter email"
            />
            <div class="error" id="error-register-email"></div>
          </div>
          <div class="control-group">
            <label for="register-password">Password</label>
            <input
              type="password"
              id="register-password"
              name="register-password"
              placeholder="Enter password"
            />
            <div class="error" id="error-register-password"></div>
          </div>
          <div class="control-group">
            <label for="register-confirm-password">Confirm Password</label>
            <input
              type="password"
              id="register-confirm-password"
              name="register-confirm-password"
              placeholder="Confirm password"
            />
            <div class="error" id="error-register-confirm-password"></div>
          </div>
          <button id="register" name="register-submit">Create Account</button>
        </form>
      </div>
    </div>
  </div>
  <?php include "inc/footer.php"; ?>
