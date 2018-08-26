<?php include('includes/init.php');
$current_page_id = 'logout';
logOut();
if(!$current_user){
  save_message("Logged out!");
}
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
  <?php include("includes/navigation.php");

  ?>
  <div id="signup">
    <div id="header-cell" class="container">
      <div class="six columns">
        <h1> Log Out </h1>
        <?php
        foreach($messages as $message){
          echo("<h3>" . htmlspecialchars($message) . "</h3>");
        } ?>
      </div>
    </div>
  </div>
  <?php
  include('includes/footer.php');
  ?>
</body>
</html>
