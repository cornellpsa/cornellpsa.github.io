<?php
$current_page_id = 'index';
include('includes/init.php');
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
  <div class ="container">
    <div class="home row">
      <div class="eight columns">
        <h2>Cornell Pakistani Students Association</h2>
        <a class="button" href=contact.php>Join Our List Serv</a>
      </div>
      <div class="four columns">
        <img src="photos/CornellPSA.jpg" alt="Cornell PSA"/>
        <h5>Photo from Cornell PSA Facebook Page</h5>
      </div>
    </div>
  </div>

  <div class ="container">
    <div class="home row">
      <div class="six columns">
        <h2>About Us</h2>
        <p>The Pakistani Students Association (PSA) is an organization and community for
        all Cornell Members of Pakistani background and those with interests in
        Pakistani culture and identity.</p>
        <a class="button" href=about.php>Learn More</a>
      </div>
      <div class="four offset-by-two columns">
        <img src="photos/PSAabout.jpg" alt="PSA About"/>
        <h5>Photo from Cornell PSA Facebook Page</h5>
      </div>
    </div>
  </div>

  <div class ="container">
    <div class="home row">
      <div class="eight columns">
        <h2>Events</h2>
        <p>Click below to view some of our events</p>
        <a class="button" href=events.php>View</a>
      </div>
      <div class="four columns">
        <img src="photos/kite2.jpeg" alt="event"/>
        <h5>Photo from Cornell PSA Facebook Page</h5>
      </div>
    </div>
  </div>

  <div class ="container">
    <div class="home last row">
      <div class="eight columns">
        <h2>Housing</h2>
        <p>Click below to learn more about housing matching.</p>
        <a class="button" href=housing.php>Learn More</a>
      </div>
      <div class="four columns">
        <img src="photos/housingpic.jpg" alt="housing"/>
        <h5>Photo from Cornell PSA Facebook Page</h5>
      </div>
    </div>
  </div>

  <?php
  include('includes/footer.php');
  ?>
</body>
</html>
