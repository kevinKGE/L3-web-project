<?php
require_once 'source/head.php';
require_once '../public/Donnees.inc.php';

if (isset($_POST['submit3'])) {
    ?>
        <nav id='nav_index'>
    <?php

    echo $_POST['submit3'];

    $result = array (
        'include' => $include = array(),
        'exclude' => $exclude = array(),
        'unknown'=> $unknown = array(),
        'ListIngredients' => $ListIngredients = array(),
        'PrintSearch' => $Affichage = array('score' => 0),
                                            
    );
    $search = $_POST['search'];

    preg_match_all('/[-+]?"[^"]+"|[^ ]+/', $search, $matches);

    // Check if search is empty
    if(empty($search)){
        ?><p>Veuillez saisir une recipe</p><?php
    } // Check if search is valid
    else if(preg_match('/[^a-zÀ-ú" +-]/i', $search)){
        ?><p>Veuillez saisir une recipe valide</p><?php
    }
    else{
        // Check if number of quotes is even

       if(substr_count($search, '"' ) % 2 != 0){
            ?><p>Nombre de guillemets impairs</p><?php
        }
        else{
            // Check if number of + is even
            foreach ($matches[0] as $matches) {
                $key = substr($matches, 0, 1);
                if ($key == '+') {
                        if(!in_array(substr($matches, 1), $result['include'])){
                            $result['include'][] = substr($matches, 1);
                        }
                } else if ($key == '-') {
                        if(!in_array(substr($matches, 1), $result['exclude'])){
                            $result['exclude'][] = substr($matches, 1);
                        }
                } 
                else if($key == '"'){
                    if(!in_array(substr($matches, 1, -1), $result['include'])){
                        $result['include'][] = substr($matches, 1, -1);
                    }
                }
                else{
                    if(!in_array($matches, $result['include'])){
                        $result['include'][] = $matches;;
                    }
                }

        }

        foreach($Recettes as $OneRecipe => $ListInRecettes){
            foreach($ListInRecettes[array_keys($ListInRecettes)[3]] as $rank => $ingredient){
                if(!in_array($ingredient, $result['ListIngredients'])){
                    $result['ListIngredients'][] = $ingredient;
                }
            }
          }

          // Remove duplicate in $result['ListIngredients']
          $result['ListIngredients'] = array_unique($result['ListIngredients']);


        ?>
            <div class="strong_front">
                Liste des Aliment souhaiter :
            </div>

            <ul>
        <?php
       
      
        foreach ($result['include'] as $i => $value) {
           foreach ($result['ListIngredients'] as $j => $value2) {
                if ($value == $value2){
                    ?><li><?php echo $result['include'][$i]; ?></li><?php
                } else {
                    $result['unknown'][] = $value;
                }
            }
        }
        ?>
            </ul>
        <?php
    }
        ?>
        <div class="strong_front">
            Liste des Aliment a exclure :
        </div>

        <ul>
        <?php
        foreach ($result['exclude'] as $i => $value) {
            foreach ($result['ListIngredients'] as $j => $value2) {
                if($value == $value2){
                    ?><li><?php echo $result['exclude'][$i]; ?></li><?php
                }
                else{
                    $result['unknown'][] = $value;
                }
            }
        }
        ?>
            </ul>
        <?php

    foreach ($Recettes as $recipe) {
        $score = 0;
        foreach ($result["exclude"] as $exclude) {
            foreach($recipe['index'] as $index){
                if(preg_match("/$exclude/i", $index)){
                    $score--;
                    continue 2;
                }
            }
        }
        foreach ($result["include"] as $include) {
                foreach($recipe['index'] as $index){
                    if(preg_match("/$include/i", $index)){
                      $score++;
                     }
                }
        }
        
        if(empty($result["include"]))
            {
                if($score == 0)
                $result["PrintSearch"][] = $recipe;
            }
        else if ($score > 0) {
            $result["PrintSearch"]['score'] = $score;
            $result["PrintSearch"][] = $recipe;
            
        }

        }
        
        ?>
            </nav>
            <main>
        <?php

        foreach($result['PrintSearch'] as $index_recipe => $recipes){ // For each recipe
            if($index_recipe != 0){ 
                $nb_max_score = get_max_score($result["include"], $result["exclude"]); // Get the max score
                $nb_score = get_score($result["include"], $result["exclude"], $recipes); // Get the score of the recipe
                
                if($nb_score > $nb_max_score){  // If the score is higher than the max score
                    $nb_score = $nb_max_score;
                }
                $T[$nb_score][] = $recipes; // Add the recipe to the array
            } 
        }

    if(!empty($T)){ // If the array is not empty
        krsort($T); // Sort the array by score

        foreach ($T as $index_t => $recipes_t){   
            foreach ($recipes_t as $index_recipe => $recipes){  
            
                if($index_recipe != 0){
                    $title = $recipes[array_keys($recipes)[0]]; // Get the title of the recipe
                    $index = $recipes[array_keys($recipes)[3]]; // Get the index of the recipe
                    $name = valid_name($title); // Get the name of the recipe
                    $res =  get_index($title); // Get the index of the recipe
                    $nb_max_score = get_max_score($result["include"], $result["exclude"]); // Get the max score
                    $nb_score = get_score($result["include"], $result["exclude"], $recipes); // Get the score of the recipe
                    
    
                    if($nb_score > $nb_max_score){ // If the score is higher than the max score
                        $nb_score = $nb_max_score;
                    }
    
                    $pourcent = ($nb_score * 100) / $nb_max_score; // Get the percentage of the score
                    $pourcent = round($pourcent, 2); // Round the percentage
        
                    if (!file_exists("../public/photos/" . $name)) { // If the photo doesn't exist
                        $name = 'cocktail.png';
                    }
    
                ?>
                    <div class="card" style="width: 18rem;">                    
                        <button class="button" id="<?php echo $res; ?>">
                            <?php if (isset($_SESSION['favorites_temp']) || isset($favorites)){
                    if(isset($_SESSION['favorites_temp'])){
                            $favorites_temp = $_SESSION['favorites_temp'];
                        }else{
                            $favorites_temp = array();
                        }
                        if(isset($favorites)){
                            $favorite = $favorites;
                        }else{
                            $favorite = array();
                        }

                    if (in_array($res, $favorites_temp) || in_array($res, $favorite)) {
                                    ?><img src="../public/photos/heart_full.png" alt=""><?php
                                } else {
                                    ?><img src="../public/photos/heart_empty.png" alt=""><?php
                                }
                            } else {
                                ?><img src="../public/photos/heart_empty.png" alt=""><?php
                            }?>
                        </button>
                        <img src="../public/photos/<?php echo $name; ?>" alt="" width="100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="?recipe=<?php echo $title; ?>"><?php echo $title; ?></a>
                            </h5>
                            <p class='card-text'>
                            <ul>
                                <?php
                                foreach ($index as $key => $value) {
                                ?><li> <?php echo $value; ?> </li> <?php
                                                                }
                                                                    ?>
                            </ul>
                            </p>
                            <p>
                                <?php echo $pourcent; ?> %
                            </p>
    
                        </div>
                    </div>
                    <?php
                    }
        }
        
            }

    }
        
        

    
    ?>
        </main>
    <?php
    }
}

?>

<script>
    $('.button').on('click', function() {
        var img = $(this).find('img');
        if(img.attr('src').match('../public/photos/heart_empty.png')) {
            img.attr('src', '../public/photos/heart_full.png');
        } else {
            img.attr('src', '../public/photos/heart_empty.png');
        }

        $.ajax({
            url: '../public/favorites_like.inc.php',
            type: 'GET',
            data: {
                index: (this.id)
            }
        });
    }
    );
</script>