<?php
    session_start();

    $indice = null;

     
        if (isset($_GET['indice'])) {           //Si on a cliquer sur un bouton like
            if (isset($_SESSION['like'])) {     //Si j'ai des recettes liker en session
                $indice = $_SESSION['like'];    //On les met dans un tableau
            }
            
            if ($indice != null && in_array($_GET['indice'], $indice)) {
                            //Si la recette liker est dans le tableau
                array_splice($indice, array_search($_GET['indice'], $indice),1);    //On la supprime
                
                if (count($indice) == 0) {                                          //Si le tableau est vide
                    $indice = null;                                                 //On le met a null
                }
            }else
            {
                $indice[] = $_GET['indice'];                                        //Sinon on ajoute la recette liker dans le tableau
            }
            $_SESSION['like'] = $indice;                                            //On met le tableau dans la session
        }    
        
        if(isset($_SESSION['user'])){
            file_put_contents('../public/favorites/'.$_SESSION['user']['login'].'.favorites.inc.php', '<?php $favorites = '.var_export($_SESSION['like'], true).';');
        }
    
?>