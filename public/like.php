<?php
    session_start();

    $index = null;

     
        if (isset($_GET['index'])) {           //Si on a cliquer sur un bouton like
            if (isset($_SESSION['favorites_temp'])) {     //Si j'ai des recettes liker en session
                $index = $_SESSION['favorites_temp'];    //On les met dans un tableau
            }
            
            if ($index != null && in_array($_GET['index'], $index)) {
                            //Si la recette liker est dans le tableau
                array_splice($index, array_search($_GET['index'], $index),1);    //On la supprime
                
                if (count($index) == 0) {                                          //Si le tableau est vide
                    $index = null;                                                 //On le met a null
                }
            }else
            {
                $index[] = $_GET['index'];                                        //Sinon on ajoute la recette liker dans le tableau
            }
            $_SESSION['favorites_temp'] = $index;                                            //On met le tableau dans la session
        }    
        
        if(isset($_SESSION['user'])){
            file_put_contents('../public/favorites/'.$_SESSION['user']['login'].'.favorites.inc.php', '<?php $favorites = '.var_export($_SESSION['favorites_temp'], true).';');
        }
    
?>