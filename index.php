<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jobscrapper</title>
</head> 
<body>
  <?php 
  mb_internal_encoding("UTF-8"); //Set encoding to UTF-8 to deal with greek locale
  include './simple_html_dom.php'; //DOM Parser
  $html = file_get_html('https://www.kariera.gr/%CE%AD%CF%81%CE%B5%CF%85%CE%BD%CE%B1?q=%CE%BC%CE%B7%CF%87%CE%B1%CE%BD%CE%B9%CE%BA%CF%8C%CF%82&loc=%CE%91%CE%B8%CE%AE%CE%BD%CE%B1'); //Load page with sample search
  //Read number of pages
  foreach($html->find('table.jobList_table div[id=paginationBottom]') as $element) {
    $pages =  $element->plaintext; //Take string containing information of pagination
    $pagelength = mb_substr($pages, 47, 70); // returns the max number page
  }
  
  foreach($html->find('table.jobList_table h2') as $element){
    $item['title'] =  $element->plaintext."<br>";
    $item['time'] = $element->nextsibling()->plaintext."<br>";
    $item['body'] = $element->nextsibling(1)->nextsibling(1)->plaintext."<br>";
    $item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->innertext()."<br>";
    echo $item['title'];
    echo $item['time'];
    echo $item['body'];
    echo $item['link'];
  }

  $html->clear(); 
  unset($html);
 ?>
</body>
</html>
