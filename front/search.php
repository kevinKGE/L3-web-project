<?php
require_once 'source/head.php';
//require_once 'source/header.php';
require_once '../public/Donnees.inc.php';


if (isset($_POST['submit3'])) {
    echo "<nav id='nav_index'>";
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


        echo "<strong>Liste des Aliment souhaiter :</strong>";
        echo "<br>";
        echo "<ul>";
        foreach ($result['include'] as $i => $value) {
           foreach ($result['ListIngredients'] as $j => $value2) {
                if($value == $value2){
                    
                    echo "<li>" . $result['include'][$i] . "</li>";
                    
                }
                else{
                    $result['unknown'][] = $value;
                }
            }
        }
        echo "</ul>";
    }
        echo "<br>";
        echo "<strong>Liste des Aliment a exclure :</strong>";
        echo "<br>";
        echo "<ul>";
        foreach ($result['exclude'] as $i => $value) {
            foreach ($result['ListIngredients'] as $j => $value2) {
                if($value == $value2){
                   
                    echo "<li>" . $result['exclude'][$i] . "</li>";
                   
                }
                else{
                    $result['unknown'][] = $value;
                }
            }
        }
        echo "</ul>";

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

        echo "</nav>";
        echo "<main>";

    /**Affiche tout les éléments du tableau $result["PrintSearch"]["List] */
    foreach ($result['PrintSearch'] as $index_recipe => $recipes){
        if($index_recipe != 0){
            $title = $recipes[array_keys($recipes)[0]];
            $index = $recipes[array_keys($recipes)[3]];
    
            $name = valid_name($title);
    
            if(!file_exists("../public/photos/".$name)){
                $name = 'cocktail.png';
            }

            echo "<div class='card' style='width: 18rem;'>";
    
            echo "<div class='button'>";
            echo "<input type='image' src='../public/photos/heart_empty.png' id='button' onclick='fav('button')'/>";
            echo "</div>";
    
            echo '<img src="../public/photos/' . $name . '" alt="img" width="100">';
            echo "<div class='card-body'>";
                
                    echo "<h5 class='card-title'>";
                        echo "<a href='?recipe=" . $title . "'>" . $title . "</a>"; 
                    echo "</h5>";
                echo "<p class='card-text'> <ul>";
                    foreach($index as $key => $value){ 
                        echo "<li>" . $value . "</li>";
                    }
                echo "</ul> </p>";
                echo "</div>";
            echo "</div>";       
        }
    }
    echo "</main>";
}
}
?>