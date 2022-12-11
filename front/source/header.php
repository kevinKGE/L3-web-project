<?php

require_once '../public/functions.inc.php';
require_once '../public/regex.inc.php';
require_once '../public/Donnees.inc.php';

$_SESSION['favorites'] = array();

if(isset($_SESSION['user'])){
    require_once '../public/favorites/'.$_SESSION['user']['login'].'.favorites.inc.php';
    $_SESSION['favorites'] = $favorites;
}

if (isset($_POST['submit2'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    // check if the login and password are not empty
    if ($login && $password) {
        // check if the login and password are correct
        $user = login($login, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            // add the favorites to the session into the favorites file
            foreach($_SESSION['favorites'] as $key => $value){
                if(!in_array($value, $_SESSION['favorites_temp'])){
                    $_SESSION['favorites_temp'] += $value;
                }
            }
            if(!empty($_SESSION['favorites_temp'])){
                file_put_contents('../public/favorites/'.$_SESSION['user']['login'].'.favorites.inc.php', '<?php $favorites = '.var_export($_SESSION['favorites_temp'], true).';');
            }
        } else {
            echo 'Mauvais login ou mot de passe !<br>';
        }
    }
}
?>

<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <form class="container-fluid justify-content-start">
                <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./index.php'">Navigation</button>
                <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./favorites.php'">Recettes <i class="bi bi-heart-fill"></i></button>
            </form>
            <form class="d-flex" role="search" name="search" method="POST">
                <label class="">Recette: </label>
                <input class="form-control me-2" name="search" type="search" placeholder="" aria-label="Search">
                <button class="btn btn-outline-success" name="submit3" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <?php
            if (isset($_SESSION['user'])) { ?>
                <form class="container-fluid justify-content-start">
                    <div>
                        <?php if (isset($_SESSION['user']['name'])) {
                            echo $_SESSION['user']['login'];
                        } ?>
                    </div>
                    <a class="btn btn-outline-success me-2" href="../front/profile.php">Profil</a>
                    <a class="btn btn-outline-success me-2" href="../public/logout.inc.php">Se déconnecter</a>
                </form>
            <?php
            } else { ?>
                <form class="container-fluid justify-content-start" action="./" method="POST">
                    <label>Login</label>
                    <input name="login">
                    <label>Mot de passe</label>
                    <input name='password'>
                    <button class="btn btn-outline-success me-2" type="submit" name="submit2">Connexion</button>
                </form>
                <button class="btn btn-outline-success me-2" type="button" onclick="window.location.href='./signup.php'">S'inscrire</button>
            <?php
            }
            ?>
        </div>
    </nav>
</header>