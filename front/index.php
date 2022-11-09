<!-- Data treatment -->

<?php
session_start();
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/users.inc.php';
require_once '../public/Donnees.inc.php';

// ************* essais Kevin : ************** //
/*if (isset($_POST['submit'])) {
    echo "</br>contenue de POST : </br>";
    foreach ($_POST as $key => $value) {
        echo $key . " : " . $value . "</br>";
    };
}
echo "</br>essai d'affichage de POST : </br>";
print_r(array_values($_POST));

echo "</br>contenue de mes données users : </br>";
foreach ($users as $user) {
    foreach ($user as $value) {
        echo $value . "</br>";
    }
}

echo "</br>contenue de mes données users : </br>";
print_r(array_values($users));*/

// ************* fin essais Kevin ************* //

// ******* Partie navigation ************ //


?>

<nav>
    <?php
        require_once 'navigation.php';
    ?>
</nav>

<main>
    <?php
    //mettre les differentes recette correcspondant aux recherches
    // + mettre le coeur rouge si il y en a un 
    //faire une verification dans ce type la pour filtrer la gestion des cookie et de favori

    //exemple pris de l'exo final de TD
            //l'utilisateur est il identifié?
            /* if(isset($_SESSION['user']))    
            {    if(!isset($_GET['page'])) $_GET['page']='accueil';
                // L'utilisateur accède-t-il à une page autorisée
                if(in_array($_GET['page'],array('accueil','rubrique','facturation')))
                {    include($_GET['page'].".php");
                }
            }
            else include('identification.php');*/
    ?>
</main>

<?php
require_once 'source/footer.php';
?>