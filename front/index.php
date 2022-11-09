<!-- Data treatment -->

<?php
session_start();
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/users.inc.php';

// ************* essais : ************** //
if (isset($_POST['submit'])) {
    echo "</br>contenue de POST : </br>";
    foreach ($_POST as $key => $value) {
        echo $key . " : " . $value . "</br>";
    };
}
echo "</br>essai d'affichage de POST : </br>";
print_r(array_values($_POST));

echo "</br>contenue de mes données users : </br>";
print_r(array_values($users))

// ************* fin essais ************* //


?>

<nav>
    <?php
    //faire la file d'ariane
    ?>
</nav>

<main>
    <?php
    //mettre les differentes recette correcspondant aux recherches
    // + mettre le coeur rouge si il y en a un 
    ?>
</main>

<?php
require_once 'source/footer.php';
?>