<?php 
echo "  <header id='header' class='center'>
    <h1>jobscrapper.gr</h1>
    <h2>Μια μηχανή αναζήτησης αγγελιών εργασίας.</h2>
  </header><!-- /header -->
    <div id='search'>      
      <form method='post' action='results.php'>
        <div>  
          <label class='lead' for='what'>Λέξεις-κλειδιά</label><br>
          <input type='text' name='what' placeholder='Λέξεις-κλειδιά'>
        </div>
        <div>
        <label class='lead' for='where'>Περιοχή</label><br>
        <input type='text' name='where' placeholder='Περιοχή'>          
        </div>
        <div><input type='submit' name='submit' value='Search'></div>
      </form>
    </div>";
 ?>