<?php
if (isset($_POST['what']) && !empty($_POST['what'])) {
  $what = $_POST['what'];
} 
if (isset($_POST['where']) && !empty($_POST['where'])) {
  $where = $_POST['where'];
}
$url = "https://www.kariera.gr/%CE%AD%CF%81%CE%B5%CF%85%CE%BD%CE%B1?q=".$what."&loc=".$where."&rpp=50"
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jobscrapper</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
</head> 
<body class="bg-info">

  <header id="header" class="w3-center">
    <h1 class="w3-xxxlarge">jobscrapper.gr</h1>
    <h2 class="w3-xlarge">Μια μηχανή αναζήτησης αγγελιών εργασίας.</h2>
  </header><!-- /header -->
    <div id="search">      
      <form method="post" action="results.php">
        <div>  
          <label class="lead" for="what">Λέξεις-κλειδιά</label><br>
          <input type="text" name="what" placeholder="Λέξεις-κλειδιά">
        </div>
        <div>
        <label class="lead" for="where">Περιοχή</label><br>
        <input type="text" name="where" placeholder="Περιοχή">          
        </div>
        <div><input type="submit" name="submit" value="Search" class="btn"></div>
      </form>
    </div>

  <div class="w3-container w3-center bodi">

  <?php
  mb_internal_encoding("UTF-8"); //Set encoding to UTF-8 to deal with greek locale
  include './simple_html_dom.php'; //DOM Parser
  $html = file_get_html($url); //Load page with sample search
  //Generic leave commented
  // foreach($html->find('table.jobList_table') as $element){
  //   echo $element->innertext()."<br>";
  // }
  // break;

  //Read number of pages
  foreach($html->find('table.jobList_table div[id=paginationBottom]') as $element) {
    $pages =  $element->plaintext; //Take string containing information of pagination
    $pagelength = mb_substr($pages, 47, 70); // returns the max number page
    //echo $pagelength;
  }
  ?>
  <?php
  $html = file_get_html($url); //Load page with sample search
  foreach($html->find('table.jobList_table h2') as $element){
    echo "<div class='w3-panel w3-sand w3-leftbar w3-hover-border-green w3-padding'>";
    $item['title'] =  $element->plaintext."<br>";
    echo "<div class='title'>".$item['title']."</div>";
    $item['time'] = $element->nextsibling()->plaintext."<br>";
    echo "<div class='time'>".$item['time']."</div>";
    $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->innertext()."<br>";
    echo "<div class='link'>".$item['link']."</div></div>";  
  }

  for ($i=2; $i <= $pagelength ; $i++) { 
    $html = file_get_html($url."&pg=".$i); //Load page with sample search
    foreach($html->find('table.jobList_table h2') as $element){
      $item['title'] =  $element->plaintext."<br>";
      echo "<div class='title'>".$item['title']."</div>";
      $item['time'] = $element->nextsibling()->plaintext."<br>";
      echo "<div class='time'>".$item['time']."</div>";
      $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->innertext()."<br>";
      echo "<div class='link'>".$item['link']."</div>";
    }
  }
  $html->clear(); 
  unset($html);
  ?>
  </div>
  </body>
  </html>
