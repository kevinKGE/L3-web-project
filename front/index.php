<!-- Data treatment -->

<?php
session_start();
require_once 'source/head.php';
require_once 'source/header.php';
require_once '../public/Donnees.inc.php';
require_once '../public/functions.php';

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

// créer une connexion d'utilisateur avec les fichiers users.inc.php
// ICI à tester (ne pas oublier de rendre la partie connextion sous forme de formulaire)
if (isset($_POST['submit'])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlspecialchars(trim($_POST['password']));
    $userToConnect = array(
        'login' => $login,
        'password' => $password
    );
    if ($login && $password) {
        if (preg_match($loginRegex, $userToConnect['login'])) {
            if (preg_match('$([A-Z][a-z][0-9] -\')+$', $userToConnect['password'])) {
                user_connect($userToConnect);
                echo 'Connexion réussie';
            } else echo "Votre mot de passe doit contenir uniquement des lettres et des chiffres";
        } else echo "Votre login doit contenir uniquement des lettres et des chiffres";
    } else echo "Veuillez saisir tous les champs obligatoires !";
}

?>

<nav>
    <?php
        require_once 'navigation.php';
    ?>
</nav>

<main>
    <?php
        require_once 'main.php';
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