<?php
$current_page_id = 'login';
include('includes/init.php');
global $messages;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Home</title>
</head>

<body>
  <?php
  include('includes/navigation.php');
   ?>
  <div id="signup">
    <div id="header-cell" class="container">
      <div class="row">
      <div class="six columns">
        <h1> Log In </h1>
        <h3>Log in to get access to the housing page and find potential roommates!</h3>
      </div>
    </div>
  </div>

    <div class="container">
      <div class="twelve columns">
        <?php
        foreach($messages as $message){
          echo("<h3>" . htmlspecialchars($message) . "</h3>");
        }

        ?>
        <?php
        if(!$current_user){
          echo("
          <div id='loginforms'>
          <form id='loginForm' action='login.php' method='post'>
          <div class='four columns'>
          <label class='four columns'>Username:</label>
          <input class='u-full-width' type='text' name='username' required/>
          </div>
          <div class='four columns'>
          <label class='four columns'>Password:  </label>
          <input class='u-full-width' type='password' name='password' required/>
          </div>
          <div class = 'four columns'>
          <button name='login' type='submit'>Log In</button>
          </div>
          </form>
          </div>
          ");
        }
        ?>
      </div>
    </div>
  </div>
    <?php
    include('includes/footer.php');
    ?>

</body>
</html>
