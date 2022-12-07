<!-- Data treatment -->

<?php
// ICI session_start utile ?
session_start();
require_once 'source/head.php';
require_once 'source/header.php';

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
print_r(array_values($users));*/

// ************* fin essais Kevin ************* //

// ******* Partie navigation ************ //


?>

<nav id="nav_index">
    <?php
        require_once 'navigation.php';
    ?>
</nav>

<main>
    <?php
        require_once 'main.php';
    // + mettre le coeur rouge si il y en a un 
    //faire une verification dans ce type la pour filtrer la gestion des cookie et de favori
    ?>
</main>

<?php
require_once 'source/footer.php';
?>