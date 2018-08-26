<?php
$current_page_id = 'admin';
include('includes/init.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Admin</title>
</head>
<body>
  <?php
  include('includes/navigation.php');
  ?>
  <div id="signup">
    <div id="header-cell" class="container">
      <?php
      output_messages();
      ?>
      <!-- <div class="six columns"> -->
      <h1> List of Members: </h1>
      <h3> Admins can approve user signups here! When normal users originally sign up, their user level will be set at 0, meaning they will not be able to make any
        housing posts. Admins can go through the list of signed up users and change their user levels to be either 1 (normal user) or 2 (admin user). Normal users
        will be able to make housing posts, and admin users will be able to make edits to the website.</h3>
        <!-- </div> -->
        <?php
        $sql = "SELECT * FROM users;";
        $params = array();
        $records = exec_sql_query($db, $sql, $params)->fetchAll();
        $users = $records;
        if(!$records){
          echo("<h3> No comments! </h3>");
        }else{
          if(check_login_status() == 2){
            echo("<form id='changeUsers' action='admin.php' method='post'>");
            ?>
            <ul>
              <li>
                <label id="updatelabel" >Update a User's Status: </label>
                <select name='user_name'>
                  <?php
                  foreach($users as $user){
                    if($user['username'] == $current_user){
                      continue;
                    }
                    echo("<option value=\"" . htmlspecialchars($user['id']) . "\">" . htmlspecialchars($user['email']) . "</option>");
                  }
                  ?>
                </select>
                <select name='userstatus'>
                  <option value='0'>0</option>
                  <option value='1' selected>1</option>
                  <option value='2'>2</option>
                </select>
              </li>
              <li>
                <button name='update_status' id="updatebutton" type='submit'>Update Status</button>
              </li>
            </ul>
          </form>
          <?php
        }
        ?>
        <h1> Deleting Housing Comments: </h1>
        <h3> You can delete any comments if you deem them unnecessary here. </h3>
        <?php
        $sql = "SELECT * FROM housing;";
        $params = array();
        $records = exec_sql_query($db, $sql, $params)->fetchAll();
        $comments = $records;
        if(!$records){
          echo("<h3> No comments. </h3>");
        }else{
          if(check_login_status() == 2){
            echo("<form id='changeUsers' action='admin.php' method='post'>");
            ?>
            <ul>
              <li>
                <label id="updatelabel" >Delete Comment: </label>
                <select name='user_comment'>
                  <?php
                  foreach($comments as $comment){
                    echo("<option value=\"" . htmlspecialchars($comment['comment']) . "\">" . htmlspecialchars($comment['comment']) . "</option>");
                  }
                  ?>
                </select>
                <li>
                  <button name='delete_comment' id="updatebutton" type='submit'>Delete Comment</button>
                </li>
              </ul>
            </form>
            <?php
          }
        }
        ?>

        <h1> Listserv Dump: </h1>
        <h3> Here's a list of emails that are currently opting into the listserv. Just copy and paste this output directly to add them to the official listserv.</h3>
        <?php
        $sql = "SELECT * FROM listserv;";
        $params = array();
        $records = exec_sql_query($db, $sql, $params)->fetchAll();
        $emails = $records;
        if(!$emails){
          echo("<h3> No emails right now. </h3>");
        }else{
          foreach($emails as $email){
            echo("<p>".htmlspecialchars($email['email'])."</p>");
          }
          ?>
          <form action="admin.php" method="post">
            <button name="delete" type="submit">Delete All Emails</button>
          </form>
          <?php
        }
      }
      ?>
    </div>
  </div>
  <?php
  include('includes/footer.php');
  ?>
</body>
</html>
