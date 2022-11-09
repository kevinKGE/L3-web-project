<?php



$ListeRecipe = null;
if(!isset($_GET['page'])){
    $historique[] = 'Aliment';
    $ListRecipe=$Hierarchie['Aliment'];
}
else
{
    $historique = $_SESSION['way'];
    $historique[] = $_GET['page'];
    $ListRecipe=$Hierarchie[$_GET['page']];
}


?>
    <strong>Aliment courant</strong>
<?php
    if(isset($_GET['page'])){
        $n = count($historique);
        if(in_array($_GET['page'], $_SESSION['way'])){
            array_splice($historique, $n);
            $found = array_search($_GET['page'], $historique);
            for($n-1; $n>$found ; $n--){
                array_splice($historique, $n);
            }
        }
    }
        foreach ($historique as $key => $value) {
            ?>
                <a href="?page=<?php echo $value; ?>"> <?php echo $value; ?></a> /
            <?php
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
       
