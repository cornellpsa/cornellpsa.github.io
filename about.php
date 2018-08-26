<?php
$current_page_id = 'about';
include('includes/init.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>About</title>
</head>
<body>
<?php
include('includes/navigation.php');
 ?>

 <div class ="container">
   <div class="home row">
     <div class="twelve columns">
       <h2>About Us</h2>
       <p>PSA holds cultural events and holidays, speaker events, discussions, and
         forums featuring Pakistani speakers speaking on current events. Each event
         is not complete without our delicious Pakistani cuisine. We also cover a lot
          of current events and in the past have held Qawwali performances, mock
           shaadi/dholki celebrations, and showcased a range of student talents.
            We partner with other student organizations on campus. Each newly appointed
             Eboard aims to pursue the coherent interests of the members of our
             organization as a unified cultural group and we aim to spread awareness
             about Pakistani culture, cuisine, art and education through our yearly
             events.</p>
     </div>
   </div>
 </div>

 <div class ="container">
   <div class="home row">
     <div class="twelve columns">
       <h2>Mission</h2>
       <p>The Pakistani Students Association (PSA) is an organization and community for
         all Cornell Members of Pakistani background and those with interests in
         Pakistani culture and identity. PSA strives to educate the Cornell community
          and advocate for Pakistani issues, and celebrate Pakistani culture through
        various events throughout the year. </p>
     </div>
   </div>
 </div>

<div class ="container">
  <div class="about last row">
    <div class="row">
<!-- <div id = "pics"> -->
<?php
$sql = "SELECT * FROM pictures WHERE \"feature\" = 1";
$params = array();
$results = exec_sql_query($db, $sql, $params)->fetchAll();
foreach ($results as $result) {
  echo('<div class="four columns">');
  echo('<div class="entry">');
  echo("<img src = \"photos/" .
  $result["id"] . "." . $result["photo_ext"]. "\"" . " alt = \"".
  $result["description"] . "\">");
  echo('</div>');
  echo('</div>');
}
?>
</div>
<h5>These photos were taken from the PSA Facebook page.</h5>
</div>
</div>
<?php
include('includes/footer.php');
?>
</body>
</html>
