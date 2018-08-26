<?php
$current_page_id = 'housing';
include('includes/init.php');
$year = $_GET['year'];
if (isset($_POST['submit'])) {
  $db->beginTransaction();
  $sql = "SELECT * FROM users WHERE (username = :username)";
  $params = array(":username" => $current_user);
  $results = exec_sql_query($db, $sql, $params) -> fetchAll();
  $result = $results[0];
  $user_id = $result['id'];
  $housingcomment = filter_input(INPUT_POST, 'housingComment', FILTER_SANITIZE_STRING);
  $user = $current_user;
  $sql = "INSERT INTO housing (user_id, comment) VALUES (:user, :comment)";
  $params = array(':user' => $user_id, ':comment' => $housingcomment);
  $result = exec_sql_query($db, $sql, $params) -> fetchAll();
  $db->commit();
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Housing</title>
</head>

<body>
<?php
include('includes/navigation.php');
if (!(check_login_status() == 1 || check_login_status() == 2)) {
  save_message("You must be an approved user to access this feature. Sign up to gain approval and then log in to see our housing info!");
  echo('<div class="housing">');
  echo('<div class="container">');
  echo('<div class="row">');
  echo('<div class="six columns">');
  output_messages();
  echo('</div>');
  echo('</div>');
  echo('</div>');
  echo('</div>');
}

else { ?>
  <div class="housing-account container">
    <div class="housing-submit row">
    <div class="twelve columns">
      <h2>Housing Forum</h2>
    <form id = "housing" action='housing.php' method='post'>
      <div class="row">
      <div class="four columns">
      <h3>Enter your housing request:</h3>
    </div>
  </div>
  <div class="row">
    <div class="six columns">
      <textarea name='housingComment' required></textarea>
    </div>
  </div>
  <div class="row">
    <div class="four columns">
      <button name='submit' type='submit'>Submit</button>
    </div>
  </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="twelve columns">
    <div class="housing-posts">
      <h2>Housing Posts</h2>
  <?php
  $sql = "SELECT DISTINCT grad_year FROM users";
  $results = exec_sql_query($db, $sql) -> fetchAll();
  $grad_years = array();
  foreach ($results as $result) {
    array_push($grad_years, $result[0]);
  }
  foreach ($grad_years as $yr) {
  echo("<a class = \"housing-button\" href = \"housing.php?year=" . $yr .
    "\">Class of " . $yr . "</a>");
}
  ?>
</div>
<?php
if ($year) {//if the user wants to filter housing by specific year
  $sql = "SELECT * FROM housing LEFT OUTER JOIN users ON housing.user_id = users.id WHERE (users.grad_year = :year)";
  $params = array(":year" => $year);
  $results = exec_sql_query($db, $sql, $params)->fetchAll();
  foreach ($results as $result) { ?>
    <p class = "username"><?php echo(htmlspecialchars($result['firstname']) . " " . htmlspecialchars($result['lastname']));?></p>
    <p class = "housingComment"><?php echo(htmlspecialchars($result['comment']));?></p> <?php
  }
}
else {
  $sql = "SELECT * FROM housing LEFT OUTER JOIN users ON housing.user_id = users.id";
  $params = array();
  $results = exec_sql_query($db, $sql, $params)->fetchAll();
  foreach ($results as $result) { ?>
    <p class = "username"><?php echo(htmlspecialchars($result['firstname']) . " " . htmlspecialchars($result['lastname']));?></p>
    <p class = "housingComment"><?php echo(htmlspecialchars($result['comment']));?></p> <?php
  }
}
?>
</div>
</div>
</div>
<?php }
  include('includes/footer.php');
  ?>
</body>
</html>
