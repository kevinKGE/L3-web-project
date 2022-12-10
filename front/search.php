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
        'PrintSearch' => $Affichage = array( 'score' => 0),
                                            'list' => array(),
    );
    $search = $_POST['search'];

    preg_match_all('/[-+]?"[^"]+"|[^ ]+/', $search, $matches);


    if(empty($search)){
        ?>Veuillez saisir une recipe<?php
    }
    else if(preg_match('/[^a-zÀ-ú" +-]/i', $search)){
        ?>Veuillez saisir une recipe valide<?php
    }
    else{

       if(substr_count($search, '"' ) % 2 != 0){
            ?>Nombre de guillemets impairs<?php
        }
        else{
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
        

        if ($score > 0) {
            $result["score"] = $score;
            $result["PrintSearch"][] = $recipe;
        }

        }

       
       
        ?>
            </nav>
            <main>
        <?php

    foreach ($result['PrintSearch'] as $index_recipe => $recipes){
        
        if($index_recipe != 0){
            $title = $recipes[array_keys($recipes)[0]];
            $index = $recipes[array_keys($recipes)[3]];
            $name = valid_name($title);
            $nb_max_score = get_max_score($result["include"], $result["exclude"]);
            $nb_score = get_score($result["include"], $result["exclude"], $recipes);
            if (!file_exists("../public/photos/" . $name)) {
                $name = 'cocktail.png';
            }

            ?>
                <div class="card" style="width: 18rem;">
                    <p><?php echo $nb_max_score; ?></p>
                    <p><?php echo $nb_score; ?></p>
                    <button type="button" id="button" onclick="favoris(<?php $res ?>);"> <img id="<?php $res ?>" src="../public/photos/heart_full.png"></button>
                    <img src="../public/photos/<?php echo $name; ?>" alt="img" width="100">
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
                    </div>
                </div>
            <?php
            }
        }
    ?>
        </main>
    <?php
    }
}

?>