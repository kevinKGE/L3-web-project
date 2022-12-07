<?php
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/Donnees.inc.php';

if (isset($_POST['submit3'])) {
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
        echo 'Veuillez saisir une recipe';
    }
    else if(preg_match('/[^a-zÀ-ú" +-]/i', $search)){
        echo 'Veuillez saisir une recipe valide';
    }
    else{

       if(substr_count($search, '"' ) % 2 != 0){
            echo 'Nombre de guillemets impairs';
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


        echo "Liste des Aliment souhaiter";
        foreach ($result['include'] as $i => $value) {
           foreach ($result['ListIngredients'] as $j => $value2) {
                if($value == $value2){
                    echo " " . $result['include'][$i] . " ";
                }
                else{
                    $result['unknown'][] = $value;
                }
            }
        }
    }
        echo "<br>";
        echo "Liste des Aliment a exclure";
        foreach ($result['exclude'] as $i => $value) {
            foreach ($result['ListIngredients'] as $j => $value2) {
                if($value == $value2){
                    echo " " . $result['exclude'][$i] . " ";
                }
                else{
                    $result['unknown'][] = $value;
                }
            }
        }

foreach ($Recettes as $recipe) {
    $score = 0;
    foreach ($result["exclude"] as $exclude) {
        if (in_array($exclude, $recipe['index']))
            continue 2; 
    }
    foreach ($result["include"] as $include) {
        if (in_array($include, $recipe['index']))
            $score += 1; 
    }
    

    if ($score > 0) {
        $result["score"] = $score;
        $result["PrintSearch"][] = $recipe;
    }

    }

    /**Affiche tout les éléments du tableau $result["PrintSearch"]["List] */
    echo "<div class='recipe'>";
    foreach ($result['PrintSearch'] as $index_recipe => $recipes){
        if($index_recipe != 0){
            $title = $recipes[array_keys($recipes)[0]];
            $ingredients = $recipes[array_keys($recipes)[1]];
            $preparations = $recipes[array_keys($recipes)[2]];
            $index = $recipes[array_keys($recipes)[3]];
            $ingredients_split = split_chain($ingredients, '|');
            $preparations_split = split_chain($preparations, '.');
    
            $name = valid_name($title);
    
            if(!file_exists("../public/photos/".$name)){
                $name = 'cocktail.png';
            }

            echo "<center><h3> $title </h3></center>";
            echo "<br>";

            echo '<center><img src="../public/photos/' . $name . '" alt="img" width="200"></center>';
            echo "<br>";

            echo "<u><h4>Liste d'ingrédient :</h4></u>";
            echo "<ul>";
            foreach($ingredients_split as $key => $ingredient){
                echo "<li>" . $ingredient . "</li>";
            }
            echo "</ul>";

            echo "<br>";
            echo "<u><h4>Préparation :</h4></u>";
            echo "<ol>";
            foreach($preparations_split as $key => $preparation){
                echo "<li>" . $preparation . "</li>";
            }
            echo "</ol>";
        }
    }
    echo "</div>";
    
}
}
?>