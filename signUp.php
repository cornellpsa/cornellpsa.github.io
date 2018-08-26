<?php
$current_page_id = 'signup';
include('includes/init.php');

if (isset($_POST["signup"])) {
    $fname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $grad = filter_input(INPUT_POST, 'grad', FILTER_VALIDATE_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $username = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $user_status = 0;
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $unique_usernames = exec_sql_query($db, "SELECT DISTINCT username FROM users", NULL)->fetchAll(PDO::FETCH_COLUMN);
    $unique_emails = exec_sql_query($db, "SELECT DISTINCT email FROM users", NULL)->fetchAll(PDO::FETCH_COLUMN);

    if (!in_array($username, $unique_usernames)) {

      if (!in_array($email, $unique_emails)) {

      $sql = "INSERT INTO users (username, password, firstname, lastname, user_status, email, grad_year) VALUES (:username, :hash, :fname, :lname, :user_status, :email, :grad)";
      $params = array (
      ':username' => $username,
      ':user_status' => $user_status,
      ':fname' => $fname,
      ':lname' => $lname,
      ':hash' => $hash,
      ':email' => $email,
      ':grad' => $grad
      );
      $result = exec_sql_query($db, $sql, $params);
      if($result){
        save_message("Your account has been succesfully created! Please wait to be approved by the admins.");
      } else{
        save_message("Could not make account.");
      }
      } else {
        save_message("This email address already has an account.");
      }

    } else {
        save_message("This username already exists.");
    }
  }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Sign Up</title>
</head>
<body>
  <?php
  include('includes/navigation.php');
  ?>
  <div id="signup">
    <div id="header-cell" class="container">
      <div class="six columns">
        <h2 class="bold">Sign Up</h2>
        <h3>Sign up with Cornell PSA to receive special membership to housing forums, emails, and photos!</h3>
        <?php
        output_messages();
         ?>
      </div>
    </div>
    <div class="container">
      <div class="twelve columns">
        <form action="signup.php" method="post">
              <div class="row">
                <div class="four columns">
                  <h3 class="label">First Name</h3>
                  <input class="u-full-width" type="text" name="firstname" required/>
                </div>
                <div class="four columns">
                  <h3 class="label">Last Name</h3>
                  <input class="u-full-width" type="text" name="lastname" required/>
                </div>
                <div class="four columns">
                  <h3 class="label">Graduation Year</h3>
                  <input class="u-full-width" type="number" min="2018" max="2999" name="grad" required/>
                </div>
                <div class="four columns">
                  <h3 class="label">Email Address</h3>
                  <input class="u-full-width" type="email" name="email" required/>
                </div>
                <div class="four columns">
                  <h3 class="label">Username</h3>
                  <input class="u-full-width" type="text" name="username" required/>
                </div>
                <div class="four columns">
                  <h3 class="label">Password</h3>
                  <input class="u-full-width" type="password" name="password" required/>
                </div>
              </div>
              <div class="three columns">
                <button name="signup" type="submit">Sign Up</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
      include('includes/footer.php');
      ?>
</body>
</html>
