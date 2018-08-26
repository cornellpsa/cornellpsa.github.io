<?php
$messages = array();
$users = array();

$pages = array(
  "about"=>"About",
  "events"=>"Events",
  "housing"=>"Housing",
  "contact"=>"Contact",
  "signup"=>"Sign Up",
  "admin" =>"Admin",
  "login"=>"Log In");

function output_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p class='message'>" . htmlspecialchars($message) . "</p>\n";
  }
}

function exec_sql_query($db, $sql, $params = array()) {
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return NULL;
}

function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        unlink($db_filename);
        throw $exception;
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

$db = open_or_init_sqlite_db("website.sqlite", "init/init.sql");

function check_login_status() { //returns the user_status 0 if not approved user, 1 if approved user, 2 if admin
  global $db;
    if (isset($_SESSION['current_user'])) {
    $username = $_SESSION['current_user'];
    $sql = "SELECT * FROM users WHERE username = :username;";
    $params = array (
      ":username" => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $user = $records[0];
      return $user["user_status"];
    }
  }
  return NULL;
}

function islogged() {
  if (isset($_SESSION['current_user'])) {
    return $_SESSION['current_user'];
  }
  return NULL;
}


function save_message($message) {
  global $messages;
  array_push($messages, $message);
}

function get_username($user_id) {
  $sql = "SELECT * FROM users WHERE id = :user_id";
  $params = array(":user_id" => $user_id);
  $results = exec_sql_query($db, $sql, $params) -> fetchAll();
  $result = $results[0];
  return $result['username'];
}

function logIn($user, $pass) {
  global $db;
  if ($user && $pass) {
    $sql = "SELECT * FROM users WHERE username = :username;";
    $params = array(
      ':username' => $user
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
      if (password_verify($pass, $account['password'])) {
        session_regenerate_id();
        $_SESSION['current_user'] = $user;
        save_message("Logged in as $user");
        return $user;
      } else {
        save_message("Invalid password.");
      }
    } else {
      save_message("Invalid username.");
    }
  } else {
    save_message("No username or password inputted.");
  }
  return NULL;
}

function getAllUsers(){
  global $users;
  $sql = "SELECT * FROM users";
  $params = array();
  $results = exec_sql_query($db, $sql, $params) -> fetchAll();
  foreach ($results as $result) {
    array_push($users, $result['username']);
  }
  return $users;
}

function logOut() {
  global $current_user;
  $current_user = NULL;
  unset($_SESSION['current_user']);
  session_destroy();
}

session_start();

if (isset($_POST['login'])) {
  $user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $user = trim($user);
  $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $current_user = logIn($user, $pass);
} else {
  $current_user = islogged();
}

if(isset($_POST['delete'])){
  $db->beginTransaction();
  $sql = "DELETE FROM listserv;";
  $params = array();
  exec_sql_query($db,$sql,$params);
  save_message("Successfully Deleted Emails!");
  $db->commit();
}

if(isset($_POST['delete_comment'])){
  $db->beginTransaction();
  $user_comment = filter_input(INPUT_POST, 'user_comment', FILTER_SANITIZE_STRING);
  $sql = "DELETE FROM housing WHERE comment = :comm;";
  $params = array(
    ':comm' => $user_comment
  );
  exec_sql_query($db,$sql,$params);
  save_message("Successfully Deleted Comment!");
  $db->commit();
}

if(isset($_POST['update_status'])){
  $db->beginTransaction();
  $userid = filter_input(INPUT_POST, 'user_name', FILTER_VALIDATE_INT);
  $newstatus = filter_input(INPUT_POST, 'userstatus', FILTER_VALIDATE_INT); #check to make sure it's 0,1, or 2
  $sql = "UPDATE users SET user_status = :newstatus WHERE id = :id;";
  $params = array(
    ':id'=>$userid,
    ':newstatus'=>$newstatus
  );
  exec_sql_query($db,$sql,$params);
  save_message("Successfully Updated Status!");
  $db->commit();
}

?>
