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
            foreach($Recettes as $key => $value){
                if(in_array($value['ingredients'], $result['exclude'])){
                    echo " " . $result['exclude'][$i] . " ";
                }
                else{
                    unset($result['exclude'][$i]);
                }
            }
         }
        }
    }
?>