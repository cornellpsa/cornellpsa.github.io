<header>
  <nav id="menu">
    <div class="container">
      <div class="row">
        <div class="two columns">
          <a href="index.php"><h3 class="bold" id="title">Cornell PSA</h3></a>
        </div>
        <div class="ten columns">
          <div class="right-align">
            <ul class="contain">

              <?php

              if (!is_null(check_login_status())) {
                $pages = array(
                  "about"=>"About",
                  "events"=>"Events",
                  "housing"=>"Housing",
                  "contact"=>"Contact",
                  "admin" =>"Admin",
                  "login"=>"Log In");
                }

                foreach($pages as $page_id => $title) {
                  if ($page_id == $current_page_id) {
                    $id = 'id="current_page"';
                  } else {
                    $id = "";
                  }
                  if($page_id == 'login'){
                    if($current_user){
                      echo "<li><a " . $id . " href=logout.php>Logout</a></li>";
                    }else{
                      echo "<li><a " . $id . " href='" . $page_id. ".php'>$title</a></li>";
                    }
                  }
                  elseif ($page_id == 'admin'){
                    if(check_login_status() == 2){
                      echo "<li><a " . $id . " href='" . $page_id. ".php'>$title</a></li>";
                    }
                  }
                  else{
                    echo "<li><a " . $id . " href='" . $page_id. ".php'>$title</a></li>";
                  }
                }
                if($current_user){
                  echo("<li>" . $current_user . "</li>");
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
