<?php 
if(!isset($_GET['page'])){ // If the page is not defined
    $curent_page = 'Aliment'; // Add the page to the page
}
else{ // If the page is defined
    $curent_page = $_GET['page']; // Get the page where we are
}
?>

<?php
    //Get the recipe that corresponds with the ingredients (page where we are)
    $cocktails = array(); // List of cocktails to show

    $cocktails = research_recipe($curent_page, $cocktails); // Get the recipe that corresponds with the ingredients (page where we are)

    var_dump($cocktails);
    echo"<br>";


    

  require_once 'show.php'; // Show the cocktails
?>

