<?php
$ListeRecipe = null; // List of recipes

if(!isset($_GET['page'])){ // If the page is not defined
    $history[] = 'Aliment'; // Add the page to the history
    $ListRecipe=$Hierarchie['Aliment']; // Get the list of recipes
}
else{ // If the page is defined
    $history = $_SESSION['way']; // Get the history of the session
    $history[] = $_GET['page']; // Add the page to the array 'history'
    $ListRecipe=$Hierarchie[$_GET['page']]; // Get the page where we are
}

?> 
    <div class="strong_front">
        Aliment courant :
    </div> 
    <br>
<?php 

    if(isset($_GET['page'])){ // If the page is defined
        $n = count($history); // Get the number of elements in the array 'history'
        if(in_array($_GET['page'], $_SESSION['way'])){ // If the name of page is in the array 'history'
            array_splice($history, $n); // Delete the elements of the page where we are
            $found = array_search($_GET['page'], $history); // Get the position of the page where we are
            for($n-1; $n>$found ; $n--){ // Delete the elements after the page where we are
                array_splice($history, $n); 
            }
        }
    }

    foreach ($history as $key => $value) { // For each element of the array 'history'
          ?>
              <a href="?page=<?php echo $value; ?>"> <?php echo $value; ?></a> /  <!-- Create a link to the page where we are in an ariana file--> 
          <?php
        }
    ?>
    <br>
    
    <br>
    <div class="strong_front">
        Sous-catégories :
    </div> 
    
       <ul>
         <?php
       foreach ($ListRecipe as $key => $SC) { // For each element of the array 'ListRecipe', SC = sous-categorie
            if($key != "super-categorie"){ // If the element is not a super-category
                foreach($SC as $indice => $Fruit) { // For each element of the array 'sous-categorie'
                    ?>
                    <li><a href="?page=<?php echo $Fruit; ?>"> <?php echo $Fruit; ?></a> </li> <!-- Show a link word of the array $Recette -->
                    <?php
                }
            }
        }
        ?>
       </ul>
        <?php
       
       $_SESSION['way'] = $history; // Save the array history in the session
       ?>
       
