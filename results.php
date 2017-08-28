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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-info w3-container w3-center w3-text-white">

  <header id="header" class="w3-container">
    <h1 class="w3-xxxlarge">JobScrapper.gr</h1>
    <h2 class="w3-medium">Μια μηχανή αναζήτησης αγγελιών εργασίας.</h2>
  </header><!-- /header -->

    <div id="search" class="w3-cell-row w3-padding-64">      
      <form method="post" action="results.php">
        <div class="w3-container w3-cell w3-mobile">  
          <label class="w3-left" for="what">Λέξεις-κλειδιά</label><br>
          <input type="text" name="what" placeholder="Λέξεις-κλειδιά">
        </div>
        <div class="w3-container w3-cell w3-mobile">
        <label class="w3-left" for="where">Περιοχή</label><br>
        <input type="text" name="where" placeholder="Περιοχή">
        </div>
        <div class="w3-container w3-cell w3-mobile  w3-cell-bottom"><input type="submit" name="submit" value="Search" class="btn"></div>
      </form>
    </div>

  <div class="w3-container bodi">

  <?php
  mb_internal_encoding("UTF-8"); //Set encoding to UTF-8 to deal with greek locale
  include './simple_html_dom.php'; //DOM Parser
  error_reporting(0); //Turn off errors
  if (file_get_contents($url)) {
  error_reporting(E_ERROR | E_WARNING | E_PARSE); //Restore error reporting
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

  $html = file_get_html($url); //Load page with sample search
  foreach($html->find('table.jobList_table h2') as $element){
    echo "<div class='w3-panel w3-leftbar w3-hover-border-green w3-padding w3-animate-opacity'>";
    $item['title'] =  $element->plaintext."<br>";
    echo "<div class='title'>".$item['title']."</div>";
    $item['time'] = $element->nextsibling()->plaintext."<br>";
    echo "<div class='time'>".$item['time']."</div>";
    $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->firstChild(1)->firstChild(1)->childNodes(1)->outertext()."<br>";
    echo "<div class='link'>".$item['link']."</div></div>";
    flush();
    ob_flush();
    usleep(200000);
  }

  for ($i=2; $i <= $pagelength ; $i++) { 
    $html = file_get_html($url."&pg=".$i); //Load page with sample search
    foreach($html->find('table.jobList_table h2') as $element){
      echo "<div class='w3-panel w3-leftbar w3-hover-border-green w3-padding'>";
      $item['title'] =  $element->plaintext."<br>";
      echo "<div class='title'>".$item['title']."</div>";
      $item['time'] = $element->nextsibling()->plaintext."<br>";
      echo "<div class='time'>".$item['time']."</div>";
      $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->firstChild(1)->firstChild(1)->childNodes(1)->outertext()."<br>";
      echo "<div class='link'>".$item['link']."</div></div>";
    }
  }
  $html->clear(); 
  unset($html);
  }
  echo "Nothing to show";
  ?>
  </div>
  </body>
  </html>
