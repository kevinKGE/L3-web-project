<?php



$ListeRecipe = null;
if(!isset($_GET['page'])){
    $historique[] = 'Aliment';
    $ListRecipe=$Hierarchie['Aliment'];
}
else
{
    $historique[] = $_SESSION['way'];
    $historique[] = $_GET['page'];
    $ListRecipe=$Hierarchie[$_GET['page']];
}

       /********** debut de la génération php *********/
       ?>
       <ul>
         <?php
       foreach ($ListRecipe as $key => $SC) {
            if($key != "super-categorie"){
                foreach($SC as $indice => $Fruit)
                {
                    ?>
                    <li><a href="?page=<?php echo $Fruit; ?>"> <?php echo $Fruit; ?></a> </li>
                    <?php
                }
            }
        }
        ?>
       </ul>
        <?php
       /********** fin de la génération php *********/
       $_SESSION['way'] = $historique;
       var_dump($_SESSION['way']);
       ?>
