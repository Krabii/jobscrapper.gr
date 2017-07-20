<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Jobscrapper</title>
</head> 
<body>
	<?php 
include './simple_html_dom.php';
$html = file_get_html('https://www.kariera.gr/%CE%AD%CF%81%CE%B5%CF%85%CE%BD%CE%B1?q=%CE%BC%CE%B7%CF%87%CE%B1%CE%BD%CE%B9%CE%BA%CF%8C%CF%82&loc=%CE%91%CE%B8%CE%AE%CE%BD%CE%B1');

	foreach($html->find('table.jobList_table h2') as $element){
       	$item['title'] =  $element->plaintext."<br>";
       	$item['body'] = $element->nextsibling(1)->nextsibling(1)->plaintext."<br>";
       	$item['link'] =  $element->nextsibling(1)->nextsibling(1)->nextsibling(1)->childnodes(0)->firstChild(1)->innertext()."<br>";
       	//$aggelies[] = $item;
       	echo $item['title'];
       	echo $item['body'];
       	echo $item['link'];
	}
	// foreach ($aggelies as$value) {
	// 	echo $aggelies['title'].$aggelies['body'].$aggelies['link'];
	// }
    $html->clear(); 
	unset($html);
 ?>
</body>
</html>
