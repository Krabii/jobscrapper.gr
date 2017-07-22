<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jobscrapper</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head> 
<body>

  <header id="header" class="center">
    <h1>JobScrapper.gr</h1>
    <h2>Μια μηχανή αναζήτησης αγγελιών εργασίας.</h2>
  </header><!-- /header -->
    <dir id="search">
      <form>
        <div>  
          <label for="what">Λέξεις-κλειδιά</label><br>
          <input type="text" name="what" placeholder="Λέξεις-κλειδιά">
        </div>
        <div>
        <label for="where">Περιοχή</label><br>
        <input type="text" name="where" placeholder="Περιοχή">          
        </div>
      </form>
    </dir>
  <div class="container center">

  <?php 
  mb_internal_encoding("UTF-8"); //Set encoding to UTF-8 to deal with greek locale
  include './simple_html_dom.php'; //DOM Parser
  $html = file_get_html('https://www.kariera.gr/%CE%AD%CF%81%CE%B5%CF%85%CE%BD%CE%B1?q=%CE%BC%CE%B7%CF%87%CE%B1%CE%BD%CE%B9%CE%BA%CF%8C%CF%82&loc=%CE%91%CE%B8%CE%AE%CE%BD%CE%B1&rpp=50'); //Load page with sample search
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
  $html = file_get_html('https://www.kariera.gr/%CE%AD%CF%81%CE%B5%CF%85%CE%BD%CE%B1?q=%CE%BC%CE%B7%CF%87%CE%B1%CE%BD%CE%B9%CE%BA%CF%8C%CF%82&loc=%CE%91%CE%B8%CE%AE%CE%BD%CE%B1&rpp=50'); //Load page with sample search
  foreach($html->find('table.jobList_table h2') as $element){
    $item['title'] =  $element->plaintext."<br>";
    echo "<div class='title'>".$item['title']."</div>";
    $item['time'] = $element->nextsibling()->plaintext."<br>";
    echo "<div class='time'>".$item['time']."</div>";
    $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->innertext()."<br>";
    echo "<div class='link'>".$item['link']."</div>";  
  }

  // for ($i=2; $i <= $pagelength ; $i++) { 
  //   $html = file_get_html("https://www.kariera.gr/%CE%AD%CF%81%CE%B5%CF%85%CE%BD%CE%B1?q=%CE%BC%CE%B7%CF%87%CE%B1%CE%BD%CE%B9%CE%BA%CF%8C%CF%82&loc=%CE%91%CE%B8%CE%AE%CE%BD%CE%B1&rpp=50&pg=".$i); //Load page with sample search
  //   foreach($html->find('table.jobList_table h2') as $element){
  //     $item['title'] =  $element->plaintext."<br>";
  //     echo "<div class='title'>".$item['title']."</div>";
  //     $item['time'] = $element->nextsibling()->plaintext."<br>";
  //     echo "<div class='time'>".$item['time']."</div>";
  //     $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->innertext()."<br>";
  //     echo "<div class='link'>".$item['link']."</div>";
  //   }
  // }
  $html->clear(); 
  unset($html);
  ?>
  </div>
  </body>
  </html>
