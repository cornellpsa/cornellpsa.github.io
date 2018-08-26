<?php
$current_page_id = 'contact';
include('includes/init.php');
if (isset($_POST['listserv_add'])) {
    $upload_email = filter_input(INPUT_POST, 'addemail', FILTER_SANITIZE_EMAIL);
    $sql = "INSERT INTO listserv (email) VALUES (:email)";
      $params = array(
        ':email' => $upload_email,
      );
      $result = exec_sql_query($db, $sql, $params);
      if($result){
        echo"<h3><b>You have signed up for our listserv!</b></h3>";
      }
    }

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Contact</title>
</head>

<body>
<?php
include('includes/navigation.php');
 ?>
  <div class ="container">
    <div class="contact row">
      <div class="twelve columns">
        <h2>Contact Us!</h2>
        <h3>We want to keep you up to date with all of our information and upcoming events! Please join our Listserv and sign up for an account!</h3>
      </div>
    </div>
  </div>

  <div class ="container">
    <div class="contact row">
      <div class="twelve columns">
        <h2>Sign Up for an Account</h2>
        <a class="button" href=signup.php>Sign Up</a>
      </div>
    </div>
  </div>

  <div class ="container">
    <div class="contact last row">
      <div class="twelve columns">
        <h2>Join Our Listserv!</h2>
      </div>
        <form id="uploadFile" action="contact.php" method="post">
          <div class="row">
            <div class="four columns">
            <label>Enter Your Email Address</label>
            </div>
          </div>
          <div class="row">
            <div class="four columns">
            <input class="u-full-width" type='email' name='addemail' required/>
            <button name='listserv_add' type='submit'>Join</button>
          </div>
        </div>
        </form>
      </div>
    </div>

  <?php
  include('includes/footer.php');
  ?>

</body>
</html>
